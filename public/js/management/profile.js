$(() => {
    HELPER.api = {
        getData: APP_URL + "master/passenger/get-data-login",
        save: APP_URL + "master/passenger/save-data-profile"
    };

    init();
});

init = async () => {
    await HELPER.block();
    await getData();
    // await formValidationForm();
    await HELPER.unblock();
};

getData = () => {
    HELPER.ajax({
        url: HELPER.api.getData,
        data: {
            _token: $('[name="_token"]').val()
        },
        success: (res) => {
            $('#id').val(res.user_id);
            $('#name').val(res.name);
            $('#username').val(res.username);
            $('#email').val(res.email);
            $('#gender').val(res.gender);
            $('#telephone').val(res.telephone);
            $('#birth_date').val(res.birth_date);
            $('#address').val(res.address);
        },
        error: (err) => {
            HELPER.unblock();
            HELPER.showMessage({
                success: false,
                title: 'Failed',
                message: 'System error, please contact the Administrator'
            });
        }
    });
}