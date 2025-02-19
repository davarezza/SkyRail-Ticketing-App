$(document).ready(function () {
    const $paymentOptions = $(".payment-option");
    let $selectedPaymentInput = $("#selected-payment");

    $paymentOptions.on("click", function () {
        $paymentOptions.removeClass("bg-blue-100 border-blue-600")
            .find(".radio-indicator").removeClass("border-blue-600").addClass("border-gray-300")
            .find(".inner-circle").removeClass("bg-blue-600").addClass("hidden");

        $(this).addClass("bg-blue-100 border-blue-600")
            .find(".radio-indicator").removeClass("border-gray-300").addClass("border-blue-600")
            .find(".inner-circle").removeClass("hidden").addClass("bg-blue-600");

        $selectedPaymentInput.val($(this).data("method"));
    });
});
