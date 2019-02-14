window.onload = function() {
    let range = document.getElementById("rangeSlider");

    noUiSlider.create(range, {
        range: {
            min: 0,

            max: 4500
        },
        start: [0, 4000],
        // snap: true,
        connect: true,
        step: 50,
        margin: 50
    });

    var priceRangeSendDisplayOnView = [
        document.getElementById("priceRangeSendDisplayOnViewLower"),
        document.getElementById("priceRangeSendDisplayOnViewUpper")
    ];

    var priceRangeSendToForm = [
        document.getElementById("priceRangeSendToFormLower"),
        document.getElementById("priceRangeSendToFormUpper")
    ];

    range.noUiSlider.on("update", function(values, handle) {
        priceRangeSendDisplayOnView[handle].innerHTML = values[handle];
    });

    range.noUiSlider.on("update", function(values, handle) {
        priceRangeSendToForm[handle].value = values[handle];
    });

    let FlightRectLanding = document.getElementById("FlightRectLanding");

    FlightRectLanding.addEventListener("click", function() {
        let FlightsCheckId = document.getElementById("FlightsCheckId");

        if (FlightsCheckId.checked == true) {
            FlightsCheckId.checked = false;
            FlightRectLanding.classList.remove("activeLandingRect");
        } else {
            FlightsCheckId.checked = true;
            FlightRectLanding.classList.add("activeLandingRect");
        }
    });

    let VacationsRectLanding = document.getElementById("VacationsRectLanding");

    VacationsRectLanding.addEventListener("click", function() {
        let VacationsCheckId = document.getElementById("VacationsCheckId");

        if (VacationsCheckId.checked == true) {
            VacationsCheckId.checked = false;
            VacationsRectLanding.classList.remove("activeLandingRect");
        } else {
            VacationsCheckId.checked = true;
            VacationsRectLanding.classList.add("activeLandingRect");
        }
    });

    let HotelsRectLanding = document.getElementById("HotelsRectLanding");

    HotelsRectLanding.addEventListener("click", function() {
        let HotelsCheckId = document.getElementById("HotelsCheckId");

        if (HotelsCheckId.checked == true) {
            HotelsCheckId.checked = false;
            HotelsRectLanding.classList.remove("activeLandingRect");
        } else {
            HotelsCheckId.checked = true;
            HotelsRectLanding.classList.add("activeLandingRect");
        }
    });
};
