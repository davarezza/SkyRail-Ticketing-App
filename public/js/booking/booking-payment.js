$(document).ready(function () {
    const $paymentOptions = $(".payment-option");
    const $selectedPaymentInput = $("#selected-payment");

    const $modal = $("#modal-payment");
    const $modalContent = $modal.find(".bg-white");
    const $payButton = $("#pay-button");
    const $cancelButton = $("#cancel-modal");
    const $confirmButton = $("#confirm-payment");
    const $displayAmountInput = $("#total-amount");
    const $actualAmountInput = $("#total-amount-input");
    const $paymentForm = $("#payment-form");
    const paymentPrice = $("#payment_price").val();
    const $errorBox = $("#modal-payment [x-data]");

    function formatRupiah(angka, prefix) {
        let numberString = angka.replace(/[^,\d]/g, "").toString(),
            split = numberString.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] !== undefined ? rupiah + "," + split[1] : rupiah;
        return prefix === undefined ? rupiah : rupiah ? prefix + rupiah : "";
    }

    $displayAmountInput.on("keyup", function () {
        let rawValue = $(this).val().replace(/\D/g, "");
        let formattedValue = formatRupiah(rawValue, "Rp ");
        $(this).val(formattedValue);
        $actualAmountInput.val(rawValue);
    });

    function showModal() {
        $modal.removeClass("hidden").addClass("flex");
        setTimeout(() => {
            $modal.removeClass("opacity-0").addClass("opacity-100");
            $modalContent.removeClass("scale-95").addClass("scale-100");
        }, 10);
    }

    function hideModal() {
        $modal.addClass("opacity-0").removeClass("opacity-100");
        $modalContent.addClass("scale-95").removeClass("scale-100");
        $displayAmountInput.val("");
        $actualAmountInput.val("");

        setTimeout(() => {
            $modal.addClass("hidden").removeClass("flex");
        }, 300);
    }

    $payButton.on("click", function () {
        showModal();
    });

    $cancelButton.on("click", function () {
        hideModal();
    });

    $confirmButton.on("click", function () {
        const amount = $actualAmountInput.val();

        if (!amount || parseInt(amount) <= 0) {
            $errorBox.attr("x-data", `{ show: true, message: 'Please enter a valid amount!' }`);
            return;
        }

        if (parseInt(amount) !== parseInt(paymentPrice)) {
            $errorBox.attr("x-data", `{ show: true, message: 'The amount must match the required payment of Rp ${paymentPrice.replace(/\B(?=(\d{3})+(?!\d))/g, ".")}' }`);
            return;
        }

        if (amount && parseInt(amount) > 0) {
            $("<input>").attr({
                type: "hidden",
                name: "total_amount",
                value: amount
            }).appendTo($paymentForm);

            $paymentForm.submit();
        }
    });

    $modal.on("click", function (e) {
        if ($(e.target).is($modal)) {
            hideModal();
        }
    });

    $payButton.prop("disabled", true).addClass("bg-gray-400 cursor-not-allowed").removeClass("bg-blue-600 hover:bg-blue-700");

    $paymentOptions.on("click", function () {
        $paymentOptions.removeClass("bg-blue-100 border-blue-600")
            .find(".radio-indicator").removeClass("border-blue-600").addClass("border-gray-300");

        $paymentOptions.find(".inner-circle").removeClass("bg-blue-600").addClass("hidden");

        $(this).addClass("bg-blue-100 border-blue-600");
        $(this).find(".radio-indicator").removeClass("border-gray-300").addClass("border-blue-600");
        $(this).find(".inner-circle").removeClass("hidden").addClass("bg-blue-600");

        $selectedPaymentInput.val($(this).data("method"));
        let selectedMethod = $(this).data("method");
        let selectedLogo = $(this).find("img").attr("src");

        if ($selectedPaymentInput.val()) {
            $payButton.prop("disabled", false)
                .removeClass("bg-gray-400 cursor-not-allowed")
                .addClass("bg-blue-600 hover:bg-blue-700");
                $("#selected-payment-logo").attr("src", selectedLogo);
                $("#selected-payment-name").text(selectedMethod);
                $("#selected-payment-display").removeClass("hidden");
        }
    });
});
