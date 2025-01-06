
//untuk menggunakan tour tambahkan atribut berikut pada elemen html:
// data-tour="[step]-[intro text]" 
// contoh : data-tour="1-halo ini step pertama" 

// anda juga bisa membuat lebih dari satu tour dengan menambahkan mode seperti berikut:
// data-tour-add="[step]-[intro text]" 
// contoh : data-tour-add="1-halo ini step pertama" 
// lalu masukkan array berisi string nama mode anda pada atribut mode di objek parameter

// untuk step list custom, masukkan array step anda di atribut customStep di objek parameter
var INTRO = function() {
	return {
		startTour: function(config) {

			config = $.extend(true, {
				//isi dengan array berisi string mode yang ingin ditampilkan
				modes: null,
				//isi dengan array berisi objek dengan atribut element dan text intro
				customStep: null,
				//jika ingin menambahkan judul dari tour
				tourIntroTitle: '',
				tourIntroText: '',
				//jika ingin menambahkan callback function saat tour selesai
				onChangeCallbacks: [
					// {
					// 	mode: '',
					// 	step: '',
					// 	callback: function(el) {} 
					// }
				],
				onExitCallback: function() {},
				disableInteraction: true,
			}, config)
		
			const upperCase = (camel) => {
				return camel[0].toUpperCase() + camel.substring(1)
			}
		
			let steps = []
			const populateSteps = (modeSelector, dataSelector, callbacks) => {
				let stepsHTML = Array.from(document.querySelectorAll(modeSelector))
				stepsHTML.sort((a, b) => {
					return parseInt(a.dataset[dataSelector][0]) - parseInt(b.dataset[dataSelector][0])
				})
				stepsHTML.forEach((step) => {
					let tourData = step.dataset[dataSelector]
					tourData = tourData.split('-')
					let callback = callbacks.find(callback => callback.step == tourData[0])
					steps.push({
						element: step,
						intro: tourData[1],
						stepOnChange: (callback) ? callback.callback : (el)=>{}
					})
				})
			}
		
			if (config.tourIntroText !== '') {
				const currentPage = HELPER.getActivePage()
				steps.push({
					title: (config.tourIntroTitle === '') ? 
					`Selamat Datang di ${document.querySelector(`[data-con="${currentPage}"] .menu-title`).innerHTML}` 
					: config.tourIntroTitle,
					intro: config.tourIntroText
				})
			}
		
			if (config.customStep) {
				steps = config.customStep
			} else {
				if (!config.modes) {
					const modeSelector = `[data-tour]`
					const dataSelector = `tour`
					populateSteps(modeSelector, dataSelector, config?.onChangeCallbacks)
				} else {
					config.modes.forEach(mode => {
						const modeSelector = `[data-tour-${mode}]` 
						const dataSelector = `tour${upperCase(mode)}`
						const callbacks = config?.onChangeCallbacks.filter(callback => callback.mode === mode)
						populateSteps(modeSelector, dataSelector, callbacks)
					})
				}
			}
		
			introJs()
			.setOptions({
				disableInteraction: config.disableInteraction,
				steps: steps
			})
			.onchange(function() {
				let current = this._introItems[this._currentStep]
				if (current.stepOnChange) {
					current.stepOnChange(current.element);
				}
			})
			.onexit(config.onExitCallback).start()
		},
		
		// [{
		// 	element: $('.dataTables_wrapper'),
		// 	mode: 'update',
		// 	step: 1,
		// 	intro: 'tabel anda'
		// }],
		// example for steps parameter
		setTourAttribute: function(steps) {
			steps.forEach(step => {
				let attributeName = (step.mode) ? `data-tour-${step.mode}` : 'data-tour'
				step.element.attr(attributeName, `${step.step}-${step.intro}`);
			})
		}
	};
}()

