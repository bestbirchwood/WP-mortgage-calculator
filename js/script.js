jQuery(document).ready(function($) {
    $('.gmc-form').on('submit', function(event) {
        event.preventDefault();

        const monthlyDownPayment = parseFloat($('#gmc-monthly-down-payment').val());
        const interestRate = parseFloat($('#gmc-interest-rate').val()) / 100;
        const termInYears = parseInt($('#gmc-term-in-years').val());
        const brokerCommission = parseFloat($('#gmc-broker-commission').val()) / 100;
        const notaryFees = parseFloat($('#gmc-notary-fees').val()) / 100;
        const landTransferTax = parseFloat($('#gmc-land-transfer-tax').val()) / 100;        

        const monthlyInterestRate = interestRate / 12;
        const termInMonths = termInYears * 12;

        const repayment = (monthlyDownPayment * ((Math.pow(1 + monthlyInterestRate, termInMonths) - 1) / (monthlyInterestRate * Math.pow(1 + monthlyInterestRate, termInMonths)))) / (1 - (1 + brokerCommission + notaryFees + landTransferTax));
        const realHousePrice = repayment / (1 + brokerCommission + notaryFees + landTransferTax);
        const totalFinancing = repayment * termInMonths;
        const realMonthlyCharge = monthlyDownPayment * (1 + brokerCommission + notaryFees + landTransferTax);

        const results = $('.gmc-results');
        results.html('');
        results.append('<p>' + 'Real House Price: ' + realHousePrice.toFixed(2) + ' €' + '</p>');
        results.append('<p>' + 'Total Financing: ' + totalFinancing.toFixed(2) + ' €' + '</p>');
        results.append('<p>' + 'Real Monthly Charge: ' + realMonthlyCharge.toFixed(2) + ' €' + '</p>');
    });
    $('.gmc-settings-toggle').on('click', function() {
        $('.gmc-settings').slideToggle();
    });
});