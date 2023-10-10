("use strict");

let methaneThresholds = [];
let phThresholds = [];
let tempThresholds = [];
let batteryThresholds = [];

const setPlaceHolders = function () {
  document.getElementById("CH4Min").value = parseFloat(methaneThresholds[0]);
  document.getElementById("CH4Max").value = parseFloat(methaneThresholds[1]);
  document.getElementById("batMin").value = parseFloat(batteryThresholds[0]);
  document.getElementById("batMax").value = parseFloat(batteryThresholds[1]);
  document.getElementById("phRedMin").value = parseFloat(phThresholds[0]);
  document.getElementById("phYellowMin").value = parseFloat(phThresholds[1]);
  document.getElementById("phYellowMax").value = parseFloat(phThresholds[2]);
  document.getElementById("phRedMax").value = parseFloat(phThresholds[3]);
  document.getElementById("tempRedMin").value = parseFloat(tempThresholds[0]);
  document.getElementById("tempYellowMin").value = parseFloat(
    tempThresholds[1]
  );
  document.getElementById("tempYellowMax").value = parseFloat(
    tempThresholds[2]
  );
  document.getElementById("tempRedMax").value = parseFloat(tempThresholds[3]);
};

$.ajax({
  url: "getDefaultCriticalPoints.php",
  type: "POST",
  success: function (result) {
    const json_dataDCP = JSON.parse(result);
    methaneThresholds = json_dataDCP[0].methaneDefaultThreshold.split("|");
    phThresholds = json_dataDCP[0].phDefaultThreshold.split("|");
    tempThresholds = json_dataDCP[0].tempDefaultThreshold.split("|");
    batteryThresholds = json_dataDCP[0].batteryDefaultthreshold.split("|");

    console.log(parseFloat(methaneThresholds[1]));
  },
})
  .then(
    $.ajax({
      url: "getUserCriticalPoints.php",
      type: "POST",
      success: function (result) {
        const json_dataDCP = JSON.parse(result);

        if (json_dataDCP[0].useDefault == "0") {
          methaneThresholds = json_dataDCP[0].methaneThreshold.split("|");
          phThresholds = json_dataDCP[0].phThreshold.split("|");
          tempThresholds = json_dataDCP[0].tempThreshold.split("|");
          batteryThresholds = json_dataDCP[0].batteryThreshold.split("|");
        }
      },
    })
  )
  .then(setPlaceHolders);
