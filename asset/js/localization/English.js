/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: ID (English)
 */
$.extend($.validator.messages, {
    required: "This field is required.",
    remote: "Please fix this field.",
    email: "Please enter a valid email address.",
    url: "Please enter a valid URL.",
    date: "Please enter a valid date.",
    dateISO: "Please enter a valid date ( ISO ).",
    number: "Please enter a valid number.",
    digits: "Please enter only digits.",
    creditcard: "Please enter a valid credit card number.",
    equalTo: "Please enter the same value again.",
    maxlength: $.validator.format("Please enter no more than {0} characters."),
    minlength: $.validator.format("Please enter at least {0} characters."),
    rangelength: $.validator.format("Please enter a value between {0} and {1} characters long."),
    range: $.validator.format("Please enter a value between {0} and {1}."),
    max: $.validator.format("Please enter a value less than or equal to {0}."),
    min: $.validator.format("Please enter a value greater than or equal to {0}."),
    greaterThanDate:$.validator.format("End Date Must be greater than Start Date."),
    greaterThanSelling:$.validator.format("Buying Price Must be greater than selling Price."),
    greaterThanTransfer:$.validator.format("Transfer Qty Must be less than Product Qty."),
    greaterThanPurchase:$.validator.format("Receipt Qty Must be less than Purchase Qty."),
    stockLocation:$.validator.format("Same stock location is not allow to transfer"),
    greaterThanInventory:$.validator.format("Inventory Qty Must be greater than Notify Qty."),
    noSpace:$.validator.format("Space are not allowed"),
    alphanumeric:$.validator.format("Letters, Numbers, Underscore, and Dashes only please")
});
