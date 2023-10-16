//setInterval(loadDashboardData, 10000);

var init = 1;

let methaneThresholds = [];
let phThresholds = [];
let tempThresholds = [];
let batteryThresholds = [];
let last7Days = [];
let last7DaysDust = [];
let last7MassOfDust = [];
let massOfDust = [];

let last7DaysTestPower = [];
let last7DaysControlPower = [];
let last7DaysPower = [];

let last7Irradiance = [];
let last7DaysIrradiance = [];

let last7DaysCh4Values = [];
let last7DaysPressValues = [];

let months = [];
let last7MonthpHValues = [];
let last7MonthCh4Values = [];
let last7MonthPressValues = [];

let hourlyControlCurrentAvg = [];
let hourlyTestCurrentAvg = [];
let hourlyControlPowerAvg = [];
let hourlyTestPowerAvg = [];
let hourlyAvgHours = [];

var chart1,
  chart2,
  chart3,
  chart4,
  chart5,
  chart6,
  chart7,
  chart8,
  chart9,
  chart10,
  chart11,
  chart12,
  chart13,
  chart14;

function lastTen(arrayOfData) {
  //console.log(arrayOfData);
  if (arrayOfData.length > 10) {
    return arrayOfData.slice(-10);
  } else {
    return arrayOfData;
  }
}

function avg(array) {
  let sum = 0;
  for (let i = 0; i < array.length; i++) {
    sum += array[i];
  }
  return sum / array.length;
}

("use strict");

/*   setInterval(function () {
    window.location.reload(1);
  }, 300); */

/* $.ajax({
  url: "getDefaultCriticalPoints.php",
  type: "POST",
  success: function (result) {
    const json_dataDCP = JSON.parse(result);
    methaneThresholds = json_dataDCP[0].methaneDefaultThreshold.split("|");
    phThresholds = json_dataDCP[0].phDefaultThreshold.split("|");
    tempThresholds = json_dataDCP[0].tempDefaultThreshold.split("|");
    batteryThresholds = json_dataDCP[0].batteryDefaultthreshold.split("|");

    //console.log(parseFloat(methaneDefaultThreshold[1]));
  },
}).then(
  $.ajax({
    url: "getUserCriticalPoints.php",
    type: "POST",
    success: function (result) {
      const json_dataDCP = JSON.parse(result);
      console.log(json_dataDCP);

      if (json_dataDCP.length > 0) {
        if (json_dataDCP[0].useDefault == "0") {
          methaneThresholds = json_dataDCP[0].methaneThreshold.split("|");
          phThresholds = json_dataDCP[0].phThreshold.split("|");
          tempThresholds = json_dataDCP[0].tempThreshold.split("|");
          batteryThresholds = json_dataDCP[0].batteryThreshold.split("|");
        }
        //console.log(parseFloat(methaneDefaultThreshold[1]));
      }
    },
  })
); */

$.ajax({
  url: "getIrradianceData.php",
  type: "POST",
  success: function (result) {
    const json_data7 = JSON.parse(result);
    let index = 0;
    for (const obj of json_data7) {
      last7DaysIrradiance[index] = obj.dayOfWeek;
      last7Irradiance[index] = parseFloat(obj.irradiance).toFixed(2);
      index++;
    }
    console.log(last7Irradiance);

    const weekday = [
      "Sunday",
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday",
      "Saturday",
    ];

    const d = new Date();
    let dayNumber = d.getDay();
    let day = weekday[d.getDay()];
    let yesterday = weekday[d.getDay() != 0 ? d.getDay() - 1 : 6];

    if (last7DaysIrradiance.length < 7) {
      let newLast7DaysIrradiance = [];
      let newLast7Irradiance = [];

      //console.log(lastDayIndex);

      for (let i = 6; i >= 0; i--) {
        if (dayNumber - i < 0) {
          newLast7DaysIrradiance.push(weekday[7 + (dayNumber - i)]);
        } else {
          newLast7DaysIrradiance.push(weekday[dayNumber - i]);
        }
      }

      let countDay = 0;
      let indexOfDay = 0;

      for (let day of last7DaysIrradiance) {
        indexOfDay = newLast7DaysIrradiance.indexOf(day);
        //console.log("indexOfDay " + indexOfDay);

        while (indexOfDay > countDay) {
          newLast7Irradiance[countDay] = "0";
          //console.log("countDay " + countDay);
          countDay++;
        }
        if (indexOfDay === countDay) {
          newLast7Irradiance[countDay] =
            last7Irradiance[last7DaysIrradiance.indexOf(day)];

          //console.log("countDay " + countDay);
          countDay++;
        }
      }

      while (countDay <= 6) {
        newLast7Irradiance[countDay] = "0";
        //console.log("countDay" + countDay);
        countDay++;
      }
      //console.log("countDay " + countDay);

      //last7DaysIrradiance = newLast7DaysIrradiance;
      // console.log(newLast7DaysIrradiance);
      // console.log(last7DaysIrradiance);
      // console.log(last7Irradiance);
      // console.log(newLast7Irradiance);

      last7DaysIrradiance = newLast7DaysIrradiance;
      last7Irradiance = newLast7Irradiance;
      // last7Irradiance = [23, 12, 43, 87, 12, 65, 77];
      // console.log(last7DaysIrradianceCh4Values);
      // console.log(last7DaysIrradiancePressValues);
      console.log(last7Irradiance);
      // console.log(last7DaysIrradiance);
    }

    if (day === last7DaysIrradiance[last7DaysIrradiance.length - 1]) {
      last7DaysIrradiance[last7DaysIrradiance.length - 1] = "Today";
    }
    if (yesterday === last7DaysIrradiance[last7DaysIrradiance.length - 2]) {
      last7DaysIrradiance[last7DaysIrradiance.length - 2] = "Yesterday";
    }
  },
});

$.ajax({
  url: "getDustMassData.php",
  type: "POST",
  success: function (result) {
    const json_data7 = JSON.parse(result);
    let index = 0;
    for (const obj of json_data7) {
      last7DaysDust[index] = obj.dayOfWeek;
      last7MassOfDust[index] = parseFloat(obj.massOfDust).toFixed(2);

      index++;
    }
    console.log(last7MassOfDust);

    const weekday = [
      "Sunday",
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday",
      "Saturday",
    ];

    const d = new Date();
    let dayNumber = d.getDay();
    let day = weekday[d.getDay()];
    let yesterday = weekday[d.getDay() != 0 ? d.getDay() - 1 : 6];

    if (last7DaysDust.length < 7) {
      let newLast7DaysDust = [];
      let newLast7MassOfDust = [];
      //console.log(lastDayIndex);

      for (let i = 6; i >= 0; i--) {
        if (dayNumber - i < 0) {
          newLast7DaysDust.push(weekday[7 + (dayNumber - i)]);
        } else {
          newLast7DaysDust.push(weekday[dayNumber - i]);
        }
      }

      let countDay = 0;
      let indexOfDay = 0;

      for (let day of last7DaysDust) {
        indexOfDay = newLast7DaysDust.indexOf(day);
        //console.log("indexOfDay " + indexOfDay);

        while (indexOfDay > countDay) {
          newLast7MassOfDust[countDay] = "0";
          //console.log("countDay " + countDay);
          countDay++;
        }
        if (indexOfDay === countDay) {
          newLast7MassOfDust[countDay] =
            last7MassOfDust[last7DaysDust.indexOf(day)];

          //console.log("countDay " + countDay);
          countDay++;
        }
      }

      while (countDay <= 6) {
        newLast7MassOfDust[countDay] = "0";
        //console.log("countDay" + countDay);
        countDay++;
      }
      //console.log("countDay " + countDay);

      //last7DaysDust = newLast7DaysDust;
      // console.log(newLast7DaysDust);
      // console.log(last7DaysDust);
      // console.log(last7MassOfDust);
      // console.log(newLast7MassOfDust);

      last7DaysDust = newLast7DaysDust;
      last7MassOfDust = newLast7MassOfDust;

      console.log(last7MassOfDust);
      // console.log(last7DaysDust);
    }

    if (day === last7DaysDust[last7DaysDust.length - 1]) {
      last7DaysDust[last7DaysDust.length - 1] = "Today";
    }
    if (yesterday === last7DaysDust[last7DaysDust.length - 2]) {
      last7DaysDust[last7DaysDust.length - 2] = "Yesterday";
    }
  },
});

$.ajax({
  url: "get7DaysAverages.php",
  type: "POST",
  success: function (result) {
    const json_data7 = JSON.parse(result);
    let index = 0;
    for (const obj of json_data7) {
      last7DaysPower[index] = obj.dayOfWeek;
      last7DaysControlPower[index] = (
        (parseFloat(obj.controlTotalPower) / 1000) *
        0.05
      ).toFixed(2);
      last7DaysTestPower[index] = (
        (parseFloat(obj.testTotalPower) / 1000) *
        0.05
      ).toFixed(2);

      index++;
    }
    // console.log(last7DaysControlPower);

    const weekday = [
      "Sunday",
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday",
      "Saturday",
    ];

    const d = new Date();
    let dayNumber = d.getDay();
    let day = weekday[d.getDay()];
    let yesterday = weekday[d.getDay() != 0 ? d.getDay() - 1 : 6];

    if (last7DaysPower.length < 7) {
      let newlast7DaysPower = [];
      let newlast7DaysControlPower = [];
      let newlast7DaysTestPower = [];

      //console.log(lastDayIndex);

      for (let i = 6; i >= 0; i--) {
        if (dayNumber - i < 0) {
          newlast7DaysPower.push(weekday[7 + (dayNumber - i)]);
        } else {
          newlast7DaysPower.push(weekday[dayNumber - i]);
        }
      }

      let countDay = 0;
      let indexOfDay = 0;

      for (let day of last7DaysPower) {
        indexOfDay = newlast7DaysPower.indexOf(day);
        //console.log("indexOfDay " + indexOfDay);

        while (indexOfDay > countDay) {
          newlast7DaysControlPower[countDay] = "0";
          newlast7DaysTestPower[countDay] = "0";

          //console.log("countDay " + countDay);
          countDay++;
        }
        if (indexOfDay === countDay) {
          newlast7DaysControlPower[countDay] =
            last7DaysControlPower[last7DaysPower.indexOf(day)];

          newlast7DaysTestPower[countDay] =
            last7DaysTestPower[last7DaysPower.indexOf(day)];

          //console.log("countDay " + countDay);
          countDay++;
        }
      }

      while (countDay <= 6) {
        newlast7DaysControlPower[countDay] = "0";
        newlast7DaysTestPower[countDay] = "0";

        //console.log("countDay" + countDay);
        countDay++;
      }
      //console.log("countDay " + countDay);

      //last7DaysPower = newlast7DaysPower;
      // console.log(newlast7DaysPower);
      // console.log(last7DaysPower);
      // console.log(last7DaysControlPower);
      // console.log(newlast7DaysControlPower);

      last7DaysPower = newlast7DaysPower;
      last7DaysControlPower = newlast7DaysControlPower;
      last7DaysTestPower = newlast7DaysTestPower;

      console.log(last7DaysControlPower);
      // console.log(last7DaysPower);
    }

    if (day === last7DaysPower[last7DaysPower.length - 1]) {
      last7DaysPower[last7DaysPower.length - 1] = "Today";
    }
    if (yesterday === last7DaysPower[last7DaysPower.length - 2]) {
      last7DaysPower[last7DaysPower.length - 2] = "Yesterday";
    }
  },
});

$.ajax({
  url: "getHourlyCurrent.php",
  type: "POST",
  success: function (result) {
    const json_data7 = JSON.parse(result);
    let index = 0;
    for (const obj of json_data7) {
      hourlyAvgHours[index] = obj.hourOfDay;
      hourlyControlCurrentAvg[index] = parseFloat(obj.controlCurrent).toFixed(
        2
      );
      hourlyTestCurrentAvg[index] = parseFloat(obj.testCurrent).toFixed(2);
      hourlyControlPowerAvg[index] = parseFloat(obj.controlPower).toFixed(2);
      hourlyTestPowerAvg[index] = parseFloat(obj.testPower).toFixed(2);

      index++;
    }
  },
});

$.ajax({
  url: "getMonthlyAverage.php",
  type: "POST",
  success: function (result) {
    const json_data7 = JSON.parse(result);
    let index = 0;
    for (const obj of json_data7) {
      months[index] = obj.months;
      last7MonthpHValues[index] = parseFloat(obj.AvgpH).toFixed(2);
      last7MonthPressValues[index] = parseFloat(obj.avgPressure).toFixed(2);
      last7MonthCh4Values[index] = parseFloat(obj.avgCh4Conc).toFixed(2);
      index++;
    }
    //console.log(last7MassOfDust);

    const monthsOfYearFull = [
      "January",
      "February",
      "March",
      "April",
      "May",
      "June",
      "July",
      "August",
      "September",
      "October",
      "November",
      "December",
    ];
    const monthsOfYearShort = [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      "Aug",
      "Sep",
      "Oct",
      "Nov",
      "Dec",
    ];

    const m = new Date();
    let monthNumber = m.getMonth();
    let thisMonth = monthsOfYearFull[monthNumber];

    if (months.length < 7) {
      let newLast7Months = [];
      let newLast7PhMonths = [];
      let newLast7Ch4Months = [];
      let newLast7PressMonths = [];
      let ind = 0;
      let lastMonthIndex = monthsOfYearFull.indexOf(months[0]);
      //console.log(lastDayIndex);

      for (let i = 6; i >= 0; i--) {
        if (monthNumber - i < 0) {
          newLast7Months.push(monthsOfYearFull[12 + (monthNumber - i)]);
        } else {
          newLast7Months.push(monthsOfYearFull[monthNumber - i]);
        }
      }

      let countMonths = 0;
      let indexOfMonths = 0;

      for (let mon of months) {
        indexOfMonths = newLast7Months.indexOf(mon);
        //console.log("indexOfMonths " + indexOfMonths);

        while (indexOfMonths > countMonths) {
          newLast7PhMonths[countMonths] = "0";
          newLast7Ch4Months[countMonths] = "0";
          newLast7PressMonths[countMonths] = "0";
          //console.log("countMonths " + countMonths);
          countMonths++;
        }
        if (indexOfMonths === countMonths) {
          newLast7PhMonths[countMonths] =
            last7MonthpHValues[months.indexOf(mon)];
          newLast7Ch4Months[countMonths] =
            last7MonthCh4Values[months.indexOf(mon)];
          newLast7PressMonths[countMonths] =
            last7MonthPressValues[months.indexOf(mon)];

          //console.log("countMonths " + countMonths);
          countMonths++;
        }
      }

      while (countMonths <= 6) {
        newLast7PhMonths[countMonths] = "0";
        newLast7Ch4Months[countMonths] = "0";
        newLast7PressMonths[countMonths] = "0";
        //console.log("countMonths" + countMonths);
        countMonths++;
      }
      //console.log("countMonths " + countMonths);

      //months = newLast7Months;
      // console.log(newLast7Months);
      // console.log(months);
      // console.log(last7MassOfDust);
      // console.log(newLast7PhMonths);

      months = newLast7Months;
      // last7MonthCh4Values = newLast7Ch4Months;
      // last7MonthPressValues = newLast7PressMonths;
      // last7MonthpHValues = newLast7PhMonths;
      last7MonthCh4Values = [23, 12, 78, 8, 77, 11, 34];
      last7MonthPressValues = [32, 14, 77, 90, 22, 12, 11];
      last7MonthpHValues = [19, 64, 49, 88, 100, 13, 86];
      console.log(last7MonthCh4Values);
      console.log(last7MonthPressValues);
      console.log(last7MonthpHValues);
      console.log(months);
    }
    last7MonthCh4Values = [23, 12, 78, 8, 77, 11, 34];
    last7MonthPressValues = [32, 14, 77, 90, 22, 12, 11];
    last7MonthpHValues = [19, 64, 49, 88, 100, 13, 86];
  },
});

$.ajax({
  url: "getLastTenData.php",
  type: "POST",
  success: function (result) {
    const json_data = JSON.parse(result);

    var horizontalData = {
      dustMassData: [0],
      pm2_5Data: [0],
      pm10Data: [0],
      ambientTempDataPM: [0],
      ambientTempDataSHT: [0],
      humidityDataPM: [0],
      humidityDataSHT: [0],
      windSpeedData: [0],
      rainFallData: [0],
      averageTemp: [0],
      averageHum: [0],
      controlPanelCurrent: [0],
      controlPanelVoltage: [0],
      controlPanelPower: [0],
      testPanelCurrent: [0],
      testPanelVoltage: [0],
      testPanelPower: [0],
      controlPanelTemp: [0],
      testPanelTemp: [0],

      time: [0],
    };

    let index = 0;
    console.log(2);
    for (const obj of json_data) {
      console.log(3);
      horizontalData["dustMassData"][index] = parseFloat(obj.massOfDust);
      horizontalData["pm2_5Data"][index] = parseFloat(
        obj.massConcentrationPm2p5
      );
      horizontalData["pm10Data"][index] = parseFloat(
        obj.massConcentrationPm10p0
      );
      horizontalData["ambientTempDataPM"][index] = parseFloat(
        obj.ambientTemperaturePM
      );
      horizontalData["ambientTempDataSHT"][index] = parseFloat(obj.ambientTemp);
      horizontalData["humidityDataPM"][index] = parseFloat(
        obj.ambientHumidityPM
      );
      horizontalData["humidityDataSHT"][index] = parseFloat(obj.humidity);
      horizontalData["windSpeedData"][index] = parseFloat(obj.windSpeed);
      horizontalData["rainFallData"][index] = parseFloat(obj.amountOfRainfall);

      horizontalData["averageTemp"][index] = (
        (parseFloat(obj.ambientTemperaturePM) + parseFloat(obj.ambientTemp)) /
        2
      ).toFixed(2);

      horizontalData["averageHum"][index] = (
        (parseFloat(obj.humidity) + parseFloat(obj.ambientHumidityPM)) /
        2
      ).toFixed(2);

      horizontalData["controlPanelCurrent"][index] = parseFloat(
        obj.panelCurrentControl
      );
      horizontalData["controlPanelVoltage"][index] = parseFloat(
        obj.panelVoltageControl
      );
      horizontalData["controlPanelPower"][index] = parseFloat(
        obj.panelPowerControl
      );

      horizontalData["testPanelCurrent"][index] = parseFloat(
        obj.panelCurrentTest
      );
      horizontalData["testPanelVoltage"][index] = parseFloat(
        obj.panelVoltageTest
      );
      horizontalData["testPanelPower"][index] = parseFloat(obj.panelPowerTest);

      horizontalData["testPanelTemp"][index] = parseFloat(obj.tempOfPanelTest);
      horizontalData["controlPanelTemp"][index] = parseFloat(
        obj.tempOfPanelControl
      );

      // horizontalData["power"][index] = parseFloat(obj.current) * parseFloat(obj.voltage);
      // adjust time by 5 hours
      const date = new Date(obj.time);
      const numOfHours = 5;
      date.setTime(date.getTime() + numOfHours * 60 * 60 * 1000);
      const updatedDate = date.toString();
      //console.log(updatedDate);
      horizontalData["time"][index] = updatedDate.slice(16, 21);

      // horizontalData["chargingState"][index] = parseFloat(obj.charging);

      index++;
    }

    if (json_data.length === 0) {
      index = 1;
    }

    horizontalData["pm2_5Data"].reverse();
    horizontalData["pm10Data"].reverse();
    horizontalData["averageTemp"].reverse();
    horizontalData["averageHum"].reverse();
    horizontalData["windSpeedData"].reverse();
    horizontalData["rainFallData"].reverse();
    horizontalData["controlPanelTemp"].reverse();
    horizontalData["testPanelTemp"].reverse();
    horizontalData["controlPanelCurrent"].reverse();
    horizontalData["controlPanelVoltage"].reverse();
    horizontalData["controlPanelPower"].reverse();
    horizontalData["testPanelCurrent"].reverse();
    horizontalData["testPanelVoltage"].reverse();
    horizontalData["testPanelPower"].reverse();

    const currentMassOfDust = horizontalData["dustMassData"][index - 1];

    const currentAmbTemp = horizontalData["averageTemp"][index - 1];
    const currentHumidity = horizontalData["averageHum"][index - 1];
    const currentPM2_5 = horizontalData["pm2_5Data"][index - 1];
    const currentPM10 = horizontalData["pm10Data"][index - 1];

    const currentWindSpeed = horizontalData["windSpeedData"][index - 1];

    const currentRainFall = horizontalData["rainFallData"][index - 1];

    const lastTenPM2_5Data = lastTen(horizontalData["pm2_5Data"]);
    const lastTenPM10Data = lastTen(horizontalData["pm10Data"]);
    const lastTenAvgTemp = lastTen(horizontalData["averageTemp"]);
    const lastTenAvgHum = lastTen(horizontalData["averageHum"]);
    const lastTenWindSpeed = lastTen(horizontalData["windSpeedData"]);
    const lastTenRainfall = lastTen(horizontalData["rainFallData"]);

    const lastTenCtrlPanelTemp = lastTen(horizontalData["controlPanelTemp"]);
    const lastTenTestPanelTemp = lastTen(horizontalData["testPanelTemp"]);

    const lastTenControlPanelCurrent = lastTen(
      horizontalData["controlPanelCurrent"]
    );
    const lastTenControlPanelVoltage = lastTen(
      horizontalData["controlPanelVoltage"]
    );
    const lastTenControlPanelPower = lastTen(
      horizontalData["controlPanelPower"]
    );

    const lastTenTestPanelCurrent = lastTen(horizontalData["testPanelCurrent"]);
    const lastTenTestPanelVoltage = lastTen(horizontalData["testPanelVoltage"]);
    const lastTenTestPanelPower = lastTen(horizontalData["testPanelPower"]);
    const maxControlPanelCurrent = Math.max(
      ...horizontalData["controlPanelCurrent"]
    );
    const minControlPanelCurrent = Math.min(
      ...horizontalData["controlPanelCurrent"]
    );
    const avgControlPanelCurrent = avg(horizontalData["controlPanelCurrent"]);

    const maxControlPanelVoltage = Math.max(
      ...horizontalData["controlPanelVoltage"]
    );
    const minControlPanelVoltage = Math.min(
      ...horizontalData["controlPanelVoltage"]
    );
    const avgControlPanelVoltage = avg(horizontalData["controlPanelVoltage"]);

    const maxControlPanelPower = Math.max(
      ...horizontalData["controlPanelPower"]
    );
    const minControlPanelPower = Math.min(
      ...horizontalData["controlPanelPower"]
    );
    const avgControlPanelPower = avg(horizontalData["controlPanelPower"]);

    const maxTestPanelCurrent = Math.max(...horizontalData["testPanelCurrent"]);
    const minTestPanelCurrent = Math.min(...horizontalData["testPanelCurrent"]);
    const avgTestPanelCurrent = avg(horizontalData["testPanelCurrent"]);

    const maxTestPanelVoltage = Math.max(...horizontalData["testPanelVoltage"]);
    const minTestPanelVoltage = Math.min(...horizontalData["testPanelVoltage"]);
    const avgTestPanelVoltage = avg(horizontalData["testPanelVoltage"]);

    const maxTestPanelPower = Math.max(...horizontalData["testPanelPower"]);
    const minTestPanelPower = Math.min(...horizontalData["testPanelPower"]);
    const avgTestPanelPower = avg(horizontalData["testPanelPower"]);

    const maxTestPanelTemp = Math.max(...horizontalData["testPanelTemp"]);
    const minTestPanelTemp = Math.min(...horizontalData["testPanelTemp"]);
    const avgTestPanelTemp = avg(horizontalData["testPanelTemp"]);

    const maxControlPanelTemp = Math.max(...horizontalData["controlPanelTemp"]);
    const minControlPanelTemp = Math.min(...horizontalData["controlPanelTemp"]);
    const avgControlPanelTemp = avg(horizontalData["controlPanelTemp"]);

    // Update dashboard Data
    document.getElementById("pm2_5").innerHTML = currentPM2_5;
    document.getElementById("pm10").innerHTML = currentPM10;
    document.getElementById("ambTemp").innerHTML = currentAmbTemp;
    document.getElementById("humidity").innerHTML = currentHumidity;
    document.getElementById("windSpeed").innerHTML = currentWindSpeed;
    document.getElementById("rainFall").innerHTML = currentRainFall;
    document.getElementById("massOfDust").innerHTML = last7MassOfDust.slice(-1);
    document.getElementById("irradiance").innerHTML = last7Irradiance.slice(-1);
    document.getElementById("ctrlCurrentAvg").innerHTML =
      avgControlPanelCurrent.toFixed(2);
    document.getElementById("ctrlCurrentMax").innerHTML =
      maxControlPanelCurrent;
    document.getElementById("ctrlCurrentMin").innerHTML =
      minControlPanelCurrent;

    document.getElementById("ctrlVoltageAvg").innerHTML =
      avgControlPanelVoltage.toFixed(2);
    document.getElementById("ctrlVoltageMax").innerHTML =
      maxControlPanelVoltage;
    document.getElementById("ctrlVoltageMin").innerHTML =
      minControlPanelVoltage;

    document.getElementById("ctrlPowerAvg").innerHTML =
      avgControlPanelPower.toFixed(2);
    document.getElementById("ctrlPowerMax").innerHTML = maxControlPanelPower;
    document.getElementById("ctrlPowerMin").innerHTML = minControlPanelPower;

    document.getElementById("testCurrentAvg").innerHTML =
      avgTestPanelCurrent.toFixed(2);
    document.getElementById("testCurrentMax").innerHTML = maxTestPanelCurrent;
    document.getElementById("testCurrentMin").innerHTML = minTestPanelCurrent;

    document.getElementById("testVoltageAvg").innerHTML =
      avgTestPanelVoltage.toFixed(2);
    document.getElementById("testVoltageMax").innerHTML = maxTestPanelVoltage;
    document.getElementById("testVoltageMin").innerHTML = minTestPanelVoltage;

    document.getElementById("testPowerAvg").innerHTML =
      avgTestPanelPower.toFixed(2);
    document.getElementById("testPowerMax").innerHTML = maxTestPanelPower;
    document.getElementById("testPowerMin").innerHTML = minTestPanelPower;

    document.getElementById("testTempAvg").innerHTML =
      avgTestPanelTemp.toFixed(2);
    document.getElementById("testTempMax").innerHTML = maxTestPanelTemp;
    document.getElementById("testTempMin").innerHTML = minTestPanelTemp;

    document.getElementById("ctrlTempAvg").innerHTML =
      avgControlPanelTemp.toFixed(2);
    document.getElementById("ctrlTempMax").innerHTML = maxControlPanelTemp;
    document.getElementById("ctrlTempMin").innerHTML = minControlPanelTemp;

    console.log(parseFloat(batteryThresholds[1]));
    // document.getElementById("batteryLevelValue").innerHTML = horizontalData["batteryLevelData"][index - 1] + "%";
    /*  */

    /*     document.getElementById("pressureValue").innerHTML =
      horizontalData["gasPressureData"][index - 1] + " hPa";

    document.getElementById("humidityValue").innerHTML =
      horizontalData["humBmeAmData"][index - 1] + "%";

    document.getElementById("tempProbes").innerHTML =
      horizontalData["tempProbeTopData"][index - 1].toFixed(1) +
      " | " +
      horizontalData["tempProbeMidData"][index - 1].toFixed(1) +
      " | " +
      horizontalData["tempProbeBottomData"][index - 1].toFixed(1);

    document.getElementById("irTempData").innerHTML =
      irTemperature.toFixed(1) + "°C";

    document.getElementById("ambiTemp").innerHTML =
      horizontalData["tempIrAmbientData"][index - 1].toFixed(1) +
      " | " +
      horizontalData["tempBmeAmData"][index - 1].toFixed(1) +
      "°C";

    if (lastChargeState == 1) {
      document.getElementById("chargingStatus").innerHTML = "Charging";
    } else {
      document.getElementById("chargingStatus").innerHTML = "Not Charging";
    } */

    // Chart 1 PM 2.5 Trend Graph

    var e = {
      series: [
        {
          name: "PM 2.5",
          data: lastTenPM2_5Data,
        },
      ],
      chart: {
        type: "area",
        height: 65,
        toolbar: {
          show: !1,
        },
        zoom: {
          enabled: !1,
        },
        dropShadow: {
          enabled: 0,
          top: 3,
          left: 14,
          blur: 4,
          opacity: 0.12,
          color: "#fff",
        },
        sparkline: {
          enabled: !0,
        },
      },
      markers: {
        size: 0,
        colors: ["#fff"],
        strokeColors: "#fff",
        strokeWidth: 2,
        hover: {
          size: 7,
        },
      },
      plotOptions: {
        bar: {
          horizontal: !1,
          columnWidth: "45%",
          endingShape: "rounded",
        },
      },
      dataLabels: {
        enabled: !1,
      },
      stroke: {
        show: !0,
        width: 2.4,
        curve: "smooth",
      },
      fill: {
        type: "gradient",
        gradient: {
          shade: "light",
          type: "vertical",
          shadeIntensity: 0.5,
          gradientToColors: ["#fff"],
          inverseColors: true,
          opacityFrom: 0.2,
          opacityTo: 0.5,
          colorStops: [],
        },
      },
      colors: ["#fff"],
      xaxis: {
        categories: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ],
      },
      tooltip: {
        theme: "dark",
        fixed: {
          enabled: !1,
        },
        x: {
          show: !1,
        },
        y: {
          title: {
            formatter: function (e) {
              return "";
            },
          },
        },
        marker: {
          show: !1,
        },
      },
    };
    new ApexCharts(document.querySelector("#w-chart1"), e).render();

    // Chart 2 PM 10 Trend Graph

    e = {
      series: [
        {
          name: "PM 10",
          data: lastTenPM10Data,
        },
      ],
      chart: {
        type: "area",
        height: 65,
        toolbar: {
          show: !1,
        },
        zoom: {
          enabled: !1,
        },
        dropShadow: {
          enabled: 0,
          top: 3,
          left: 14,
          blur: 4,
          opacity: 0.12,
          color: "#fff",
        },
        sparkline: {
          enabled: !0,
        },
      },
      markers: {
        size: 0,
        colors: ["#fff"],
        strokeColors: "#fff",
        strokeWidth: 2,
        hover: {
          size: 7,
        },
      },
      plotOptions: {
        bar: {
          horizontal: !1,
          columnWidth: "45%",
          endingShape: "rounded",
        },
      },
      dataLabels: {
        enabled: !1,
      },
      stroke: {
        show: !0,
        width: 2.4,
        curve: "smooth",
      },
      fill: {
        type: "gradient",
        gradient: {
          shade: "light",
          type: "vertical",
          shadeIntensity: 0.5,
          gradientToColors: ["#fff"],
          inverseColors: true,
          opacityFrom: 0.2,
          opacityTo: 0.5,
          colorStops: [],
        },
      },
      colors: ["#fff"],
      xaxis: {
        categories: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ],
      },
      tooltip: {
        theme: "dark",
        fixed: {
          enabled: !1,
        },
        x: {
          show: !1,
        },
        y: {
          title: {
            formatter: function (e) {
              return "";
            },
          },
        },
        marker: {
          show: !1,
        },
      },
    };
    new ApexCharts(document.querySelector("#w-chart2"), e).render();

    e = {
      series: [
        {
          name: "Soiling Loss",
          data: [240, 160, 671, 414, 555, 257, 901, 613, 727, 414, 555, 257],
        },
      ],
      chart: {
        type: "area",
        height: 65,
        toolbar: {
          show: !1,
        },
        zoom: {
          enabled: !1,
        },
        dropShadow: {
          enabled: 0,
          top: 3,
          left: 14,
          blur: 4,
          opacity: 0.12,
          color: "#fff",
        },
        sparkline: {
          enabled: !0,
        },
      },
      markers: {
        size: 0,
        colors: ["#fff"],
        strokeColors: "#fff",
        strokeWidth: 2,
        hover: {
          size: 7,
        },
      },
      plotOptions: {
        bar: {
          horizontal: !1,
          columnWidth: "45%",
          endingShape: "rounded",
        },
      },
      dataLabels: {
        enabled: !1,
      },
      stroke: {
        show: !0,
        width: 2.4,
        curve: "smooth",
      },
      fill: {
        type: "gradient",
        gradient: {
          shade: "light",
          type: "vertical",
          shadeIntensity: 0.5,
          gradientToColors: ["#fff"],
          inverseColors: true,
          opacityFrom: 0.2,
          opacityTo: 0.5,
          colorStops: [],
        },
      },
      colors: ["#fff"],
      xaxis: {
        categories: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ],
      },
      tooltip: {
        theme: "dark",
        fixed: {
          enabled: !1,
        },
        x: {
          show: !1,
        },
        y: {
          title: {
            formatter: function (e) {
              return "";
            },
          },
        },
        marker: {
          show: !1,
        },
      },
    };
    new ApexCharts(document.querySelector("#w-chart3"), e).render();

    e = {
      series: [
        {
          name: "Mass of Dust",
          data: last7MassOfDust,
        },
      ],
      chart: {
        type: "area",
        height: 65,
        toolbar: {
          show: !1,
        },
        zoom: {
          enabled: !1,
        },
        dropShadow: {
          enabled: 0,
          top: 3,
          left: 14,
          blur: 4,
          opacity: 0.12,
          color: "#fff",
        },
        sparkline: {
          enabled: !0,
        },
      },
      markers: {
        size: 0,
        colors: ["#fff"],
        strokeColors: "#fff",
        strokeWidth: 2,
        hover: {
          size: 7,
        },
      },
      plotOptions: {
        bar: {
          horizontal: !1,
          columnWidth: "45%",
          endingShape: "rounded",
        },
      },
      dataLabels: {
        enabled: !1,
      },
      stroke: {
        show: !0,
        width: 2.4,
        curve: "smooth",
      },
      fill: {
        type: "gradient",
        gradient: {
          shade: "light",
          type: "vertical",
          shadeIntensity: 0.5,
          gradientToColors: ["#fff"],
          inverseColors: true,
          opacityFrom: 0.2,
          opacityTo: 0.5,
          colorStops: [],
        },
      },
      colors: ["#fff"],
      xaxis: {
        categories: last7DaysDust,
      },
      tooltip: {
        theme: "dark",
        fixed: {
          enabled: !1,
        },
        x: {
          show: !1,
        },
        y: {
          title: {
            formatter: function (e) {
              return "";
            },
          },
        },
        marker: {
          show: !1,
        },
      },
    };
    new ApexCharts(document.querySelector("#w-chart4"), e).render();

    e = {
      series: [
        {
          name: "Irradiance",
          data: last7Irradiance,
        },
      ],
      chart: {
        type: "area",
        height: 65,
        toolbar: {
          show: !1,
        },
        zoom: {
          enabled: !1,
        },
        dropShadow: {
          enabled: 0,
          top: 3,
          left: 14,
          blur: 4,
          opacity: 0.12,
          color: "#fff",
        },
        sparkline: {
          enabled: !0,
        },
      },
      markers: {
        size: 0,
        colors: ["#fff"],
        strokeColors: "#fff",
        strokeWidth: 2,
        hover: {
          size: 7,
        },
      },
      plotOptions: {
        bar: {
          horizontal: !1,
          columnWidth: "45%",
          endingShape: "rounded",
        },
      },
      dataLabels: {
        enabled: !1,
      },
      stroke: {
        show: !0,
        width: 2.4,
        curve: "smooth",
      },
      fill: {
        type: "gradient",
        gradient: {
          shade: "light",
          type: "vertical",
          shadeIntensity: 0.5,
          gradientToColors: ["#fff"],
          inverseColors: true,
          opacityFrom: 0.2,
          opacityTo: 0.5,
          colorStops: [],
        },
      },
      colors: ["#fff"],
      xaxis: {
        categories: last7DaysIrradiance,
      },
      tooltip: {
        theme: "dark",
        fixed: {
          enabled: !1,
        },
        x: {
          show: !1,
        },
        y: {
          title: {
            formatter: function (e) {
              return "";
            },
          },
        },
        marker: {
          show: !1,
        },
      },
    };
    new ApexCharts(document.querySelector("#w-chart5"), e).render();

    e = {
      series: [
        {
          name: "Ambient Temperature",
          data: lastTenAvgTemp,
        },
      ],
      chart: {
        type: "area",
        height: 65,
        toolbar: {
          show: !1,
        },
        zoom: {
          enabled: !1,
        },
        dropShadow: {
          enabled: 0,
          top: 3,
          left: 14,
          blur: 4,
          opacity: 0.12,
          color: "#fff",
        },
        sparkline: {
          enabled: !0,
        },
      },
      markers: {
        size: 0,
        colors: ["#fff"],
        strokeColors: "#fff",
        strokeWidth: 2,
        hover: {
          size: 7,
        },
      },
      plotOptions: {
        bar: {
          horizontal: !1,
          columnWidth: "45%",
          endingShape: "rounded",
        },
      },
      dataLabels: {
        enabled: !1,
      },
      stroke: {
        show: !0,
        width: 2.4,
        curve: "smooth",
      },
      fill: {
        type: "gradient",
        gradient: {
          shade: "light",
          type: "vertical",
          shadeIntensity: 0.5,
          gradientToColors: ["#fff"],
          inverseColors: true,
          opacityFrom: 0.2,
          opacityTo: 0.5,
          colorStops: [],
        },
      },
      colors: ["#fff"],
      xaxis: {
        categories: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ],
      },
      tooltip: {
        theme: "dark",
        fixed: {
          enabled: !1,
        },
        x: {
          show: !1,
        },
        y: {
          title: {
            formatter: function (e) {
              return "";
            },
          },
        },
        marker: {
          show: !1,
        },
      },
    };
    new ApexCharts(document.querySelector("#w-chart6"), e).render();

    e = {
      series: [
        {
          name: "Average Humidity",
          data: lastTenAvgHum,
        },
      ],
      chart: {
        type: "area",
        height: 65,
        toolbar: {
          show: !1,
        },
        zoom: {
          enabled: !1,
        },
        dropShadow: {
          enabled: 0,
          top: 3,
          left: 14,
          blur: 4,
          opacity: 0.12,
          color: "#fff",
        },
        sparkline: {
          enabled: !0,
        },
      },
      markers: {
        size: 0,
        colors: ["#fff"],
        strokeColors: "#fff",
        strokeWidth: 2,
        hover: {
          size: 7,
        },
      },
      plotOptions: {
        bar: {
          horizontal: !1,
          columnWidth: "45%",
          endingShape: "rounded",
        },
      },
      dataLabels: {
        enabled: !1,
      },
      stroke: {
        show: !0,
        width: 2.4,
        curve: "smooth",
      },
      fill: {
        type: "gradient",
        gradient: {
          shade: "light",
          type: "vertical",
          shadeIntensity: 0.5,
          gradientToColors: ["#fff"],
          inverseColors: true,
          opacityFrom: 0.2,
          opacityTo: 0.5,
          colorStops: [],
        },
      },
      colors: ["#fff"],
      xaxis: {
        categories: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ],
      },
      tooltip: {
        theme: "dark",
        fixed: {
          enabled: !1,
        },
        x: {
          show: !1,
        },
        y: {
          title: {
            formatter: function (e) {
              return "";
            },
          },
        },
        marker: {
          show: !1,
        },
      },
    };
    new ApexCharts(document.querySelector("#w-chart7"), e).render();

    e = {
      series: [
        {
          name: "Wind Speed",
          data: lastTenWindSpeed,
        },
      ],
      chart: {
        type: "area",
        height: 65,
        toolbar: {
          show: !1,
        },
        zoom: {
          enabled: !1,
        },
        dropShadow: {
          enabled: 0,
          top: 3,
          left: 14,
          blur: 4,
          opacity: 0.12,
          color: "#fff",
        },
        sparkline: {
          enabled: !0,
        },
      },
      markers: {
        size: 0,
        colors: ["#fff"],
        strokeColors: "#fff",
        strokeWidth: 2,
        hover: {
          size: 7,
        },
      },
      plotOptions: {
        bar: {
          horizontal: !1,
          columnWidth: "45%",
          endingShape: "rounded",
        },
      },
      dataLabels: {
        enabled: !1,
      },
      stroke: {
        show: !0,
        width: 2.4,
        curve: "smooth",
      },
      fill: {
        type: "gradient",
        gradient: {
          shade: "light",
          type: "vertical",
          shadeIntensity: 0.5,
          gradientToColors: ["#fff"],
          inverseColors: true,
          opacityFrom: 0.2,
          opacityTo: 0.5,
          colorStops: [],
        },
      },
      colors: ["#fff"],
      xaxis: {
        categories: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ],
      },
      tooltip: {
        theme: "dark",
        fixed: {
          enabled: !1,
        },
        x: {
          show: !1,
        },
        y: {
          title: {
            formatter: function (e) {
              return "";
            },
          },
        },
        marker: {
          show: !1,
        },
      },
    };
    new ApexCharts(document.querySelector("#w-chart8"), e).render();

    e = {
      series: [
        {
          name: "Rainfall",
          data: lastTenRainfall,
        },
      ],
      chart: {
        type: "bar",
        height: 65,
        toolbar: {
          show: !1,
        },
        zoom: {
          enabled: !1,
        },
        dropShadow: {
          enabled: 0,
          top: 3,
          left: 14,
          blur: 4,
          opacity: 0.12,
          color: "#fff",
        },
        sparkline: {
          enabled: !0,
        },
      },
      markers: {
        size: 0,
        colors: ["#fff"],
        strokeColors: "#fff",
        strokeWidth: 2,
        hover: {
          size: 7,
        },
      },
      plotOptions: {
        bar: {
          horizontal: !1,
          columnWidth: "35%",
          endingShape: "rounded",
        },
      },
      dataLabels: {
        enabled: !1,
      },
      stroke: {
        show: !0,
        width: 0,
        curve: "smooth",
      },
      colors: ["#fff"],
      xaxis: {
        categories: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ],
      },
      fill: {
        opacity: 1,
      },
      tooltip: {
        theme: "dark",
        fixed: {
          enabled: !1,
        },
        x: {
          show: !1,
        },
        y: {
          title: {
            formatter: function (e) {
              return "";
            },
          },
        },
        marker: {
          show: !1,
        },
      },
    };
    new ApexCharts(document.querySelector("#w-chart9"), e).render();

    e = {
      series: [
        {
          name: "Control Current",
          data: lastTenControlPanelCurrent,
        },
      ],
      chart: {
        type: "area",
        height: 45,
        toolbar: {
          show: !1,
        },
        zoom: {
          enabled: !1,
        },
        dropShadow: {
          enabled: !1,
          top: 3,
          left: 14,
          blur: 4,
          opacity: 0.12,
          color: "#fff",
        },
        sparkline: {
          enabled: !0,
        },
      },
      markers: {
        size: 0,
        colors: ["#fff"],
        strokeColors: "#fff",
        strokeWidth: 2,
        hover: {
          size: 7,
        },
      },
      dataLabels: {
        enabled: !1,
      },
      stroke: {
        show: !0,
        width: 2,
        curve: "smooth",
      },
      fill: {
        type: "gradient",
        gradient: {
          shade: "light",
          type: "vertical",
          shadeIntensity: 0.5,
          gradientToColors: ["#fff"],
          inverseColors: true,
          opacityFrom: 0.2,
          opacityTo: 0.5,
          stops: [0, 50, 100],
          colorStops: [],
        },
      },
      colors: ["#fff"],
      xaxis: {
        categories: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ],
      },
      tooltip: {
        theme: "dark",
        fixed: {
          enabled: !1,
        },
        x: {
          show: !1,
        },
        y: {
          title: {
            formatter: function (e) {
              return "";
            },
          },
        },
        marker: {
          show: !1,
        },
      },
    };
    new ApexCharts(document.querySelector("#chart5"), e).render();
    e = {
      series: [
        {
          name: "Control Voltage",
          data: lastTenControlPanelVoltage,
        },
      ],
      chart: {
        type: "area",
        height: 45,
        toolbar: {
          show: !1,
        },
        zoom: {
          enabled: !1,
        },
        dropShadow: {
          enabled: !1,
          top: 3,
          left: 14,
          blur: 4,
          opacity: 0.12,
          color: "#fff",
        },
        sparkline: {
          enabled: !0,
        },
      },
      markers: {
        size: 0,
        colors: ["#fff"],
        strokeColors: "#fff",
        strokeWidth: 2,
        hover: {
          size: 7,
        },
      },
      dataLabels: {
        enabled: !1,
      },
      stroke: {
        show: !0,
        width: 2,
        curve: "smooth",
      },
      fill: {
        type: "gradient",
        gradient: {
          shade: "light",
          type: "vertical",
          shadeIntensity: 0.5,
          gradientToColors: ["#fff"],
          inverseColors: true,
          opacityFrom: 0.2,
          opacityTo: 0.5,
          stops: [0, 50, 100],
          colorStops: [],
        },
      },
      colors: ["#fff"],
      xaxis: {
        categories: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ],
      },
      tooltip: {
        theme: "dark",
        fixed: {
          enabled: !1,
        },
        x: {
          show: !1,
        },
        y: {
          title: {
            formatter: function (e) {
              return "";
            },
          },
        },
        marker: {
          show: !1,
        },
      },
    };
    new ApexCharts(document.querySelector("#chart6"), e).render();
    e = {
      series: [
        {
          name: "Control Power",
          data: lastTenControlPanelPower,
        },
      ],
      chart: {
        type: "area",
        height: 45,
        toolbar: {
          show: !1,
        },
        zoom: {
          enabled: !1,
        },
        dropShadow: {
          enabled: !1,
          top: 3,
          left: 14,
          blur: 4,
          opacity: 0.12,
          color: "#fff",
        },
        sparkline: {
          enabled: !0,
        },
      },
      markers: {
        size: 0,
        colors: ["#fff"],
        strokeColors: "#fff",
        strokeWidth: 2,
        hover: {
          size: 7,
        },
      },
      dataLabels: {
        enabled: !1,
      },
      stroke: {
        show: !0,
        width: 2,
        curve: "smooth",
      },
      fill: {
        type: "gradient",
        gradient: {
          shade: "light",
          type: "vertical",
          shadeIntensity: 0.5,
          gradientToColors: ["#fff"],
          inverseColors: true,
          opacityFrom: 0.2,
          opacityTo: 0.5,
          stops: [0, 50, 100],
          colorStops: [],
        },
      },
      colors: ["#fff"],
      xaxis: {
        categories: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ],
      },
      tooltip: {
        theme: "dark",
        fixed: {
          enabled: !1,
        },
        x: {
          show: !1,
        },
        y: {
          title: {
            formatter: function (e) {
              return "";
            },
          },
        },
        marker: {
          show: !1,
        },
      },
    };
    new ApexCharts(document.querySelector("#chart7"), e).render();
    e = {
      series: [
        {
          name: "Control Panel Temperature",
          data: lastTenCtrlPanelTemp,
        },
      ],
      chart: {
        type: "area",
        height: 45,
        toolbar: {
          show: !1,
        },
        zoom: {
          enabled: !1,
        },
        dropShadow: {
          enabled: !1,
          top: 3,
          left: 14,
          blur: 4,
          opacity: 0.12,
          color: "#fff",
        },
        sparkline: {
          enabled: !0,
        },
      },
      markers: {
        size: 0,
        colors: ["#fff"],
        strokeColors: "#fff",
        strokeWidth: 2,
        hover: {
          size: 7,
        },
      },
      dataLabels: {
        enabled: !1,
      },
      stroke: {
        show: !0,
        width: 2,
        curve: "smooth",
      },
      fill: {
        type: "gradient",
        gradient: {
          shade: "light",
          type: "vertical",
          shadeIntensity: 0.5,
          gradientToColors: ["#fff"],
          inverseColors: true,
          opacityFrom: 0.2,
          opacityTo: 0.5,
          stops: [0, 50, 100],
          colorStops: [],
        },
      },
      colors: ["#fff"],
      xaxis: {
        categories: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ],
      },
      tooltip: {
        theme: "dark",
        fixed: {
          enabled: !1,
        },
        x: {
          show: !1,
        },
        y: {
          title: {
            formatter: function (e) {
              return "";
            },
          },
        },
        marker: {
          show: !1,
        },
      },
    };
    new ApexCharts(document.querySelector("#chart8"), e).render();
    e = {
      series: [
        {
          name: "Test Current",
          data: lastTenTestPanelCurrent,
        },
      ],
      chart: {
        type: "area",
        height: 45,
        toolbar: {
          show: !1,
        },
        zoom: {
          enabled: !1,
        },
        dropShadow: {
          enabled: !1,
          top: 3,
          left: 14,
          blur: 4,
          opacity: 0.12,
          color: "#fff",
        },
        sparkline: {
          enabled: !0,
        },
      },
      markers: {
        size: 0,
        colors: ["#fff"],
        strokeColors: "#fff",
        strokeWidth: 2,
        hover: {
          size: 7,
        },
      },
      dataLabels: {
        enabled: !1,
      },
      stroke: {
        show: !0,
        width: 2,
        curve: "smooth",
      },
      fill: {
        type: "gradient",
        gradient: {
          shade: "light",
          type: "vertical",
          shadeIntensity: 0.5,
          gradientToColors: ["#fff"],
          inverseColors: true,
          opacityFrom: 0.2,
          opacityTo: 0.5,
          stops: [0, 50, 100],
          colorStops: [],
        },
      },
      colors: ["#fff"],
      xaxis: {
        categories: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ],
      },
      tooltip: {
        theme: "dark",
        fixed: {
          enabled: !1,
        },
        x: {
          show: !1,
        },
        y: {
          title: {
            formatter: function (e) {
              return "";
            },
          },
        },
        marker: {
          show: !1,
        },
      },
    };
    new ApexCharts(document.querySelector("#chart9"), e).render();
    e = {
      series: [
        {
          name: "Test Voltage",
          data: lastTenTestPanelVoltage,
        },
      ],
      chart: {
        type: "area",
        height: 45,
        toolbar: {
          show: !1,
        },
        zoom: {
          enabled: !1,
        },
        dropShadow: {
          enabled: !1,
          top: 3,
          left: 14,
          blur: 4,
          opacity: 0.12,
          color: "#fff",
        },
        sparkline: {
          enabled: !0,
        },
      },
      markers: {
        size: 0,
        colors: ["#fff"],
        strokeColors: "#fff",
        strokeWidth: 2,
        hover: {
          size: 7,
        },
      },
      dataLabels: {
        enabled: !1,
      },
      stroke: {
        show: !0,
        width: 2,
        curve: "smooth",
      },
      fill: {
        type: "gradient",
        gradient: {
          shade: "light",
          type: "vertical",
          shadeIntensity: 0.5,
          gradientToColors: ["#fff"],
          inverseColors: true,
          opacityFrom: 0.2,
          opacityTo: 0.5,
          stops: [0, 50, 100],
          colorStops: [],
        },
      },
      colors: ["#fff"],
      xaxis: {
        categories: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ],
      },
      tooltip: {
        theme: "dark",
        fixed: {
          enabled: !1,
        },
        x: {
          show: !1,
        },
        y: {
          title: {
            formatter: function (e) {
              return "";
            },
          },
        },
        marker: {
          show: !1,
        },
      },
    };
    new ApexCharts(document.querySelector("#chart10"), e).render();
    e = {
      series: [
        {
          name: "Test Power",
          data: lastTenTestPanelPower,
        },
      ],
      chart: {
        type: "area",
        height: 45,
        toolbar: {
          show: !1,
        },
        zoom: {
          enabled: !1,
        },
        dropShadow: {
          enabled: !1,
          top: 3,
          left: 14,
          blur: 4,
          opacity: 0.12,
          color: "#fff",
        },
        sparkline: {
          enabled: !0,
        },
      },
      markers: {
        size: 0,
        colors: ["#fff"],
        strokeColors: "#fff",
        strokeWidth: 2,
        hover: {
          size: 7,
        },
      },
      dataLabels: {
        enabled: !1,
      },
      stroke: {
        show: !0,
        width: 2,
        curve: "smooth",
      },
      fill: {
        type: "gradient",
        gradient: {
          shade: "light",
          type: "vertical",
          shadeIntensity: 0.5,
          gradientToColors: ["#fff"],
          inverseColors: true,
          opacityFrom: 0.2,
          opacityTo: 0.5,
          stops: [0, 50, 100],
          colorStops: [],
        },
      },
      colors: ["#fff"],
      xaxis: {
        categories: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ],
      },
      tooltip: {
        theme: "dark",
        fixed: {
          enabled: !1,
        },
        x: {
          show: !1,
        },
        y: {
          title: {
            formatter: function (e) {
              return "";
            },
          },
        },
        marker: {
          show: !1,
        },
      },
    };
    new ApexCharts(document.querySelector("#chart11"), e).render();
    e = {
      series: [
        {
          name: "Test Panel Temperature",
          data: lastTenTestPanelTemp,
        },
      ],
      chart: {
        type: "area",
        height: 45,
        toolbar: {
          show: !1,
        },
        zoom: {
          enabled: !1,
        },
        dropShadow: {
          enabled: !1,
          top: 3,
          left: 14,
          blur: 4,
          opacity: 0.12,
          color: "#fff",
        },
        sparkline: {
          enabled: !0,
        },
      },
      markers: {
        size: 0,
        colors: ["#fff"],
        strokeColors: "#fff",
        strokeWidth: 2,
        hover: {
          size: 7,
        },
      },
      dataLabels: {
        enabled: !1,
      },
      stroke: {
        show: !0,
        width: 2,
        curve: "smooth",
      },
      fill: {
        type: "gradient",
        gradient: {
          shade: "light",
          type: "vertical",
          shadeIntensity: 0.5,
          gradientToColors: ["#fff"],
          inverseColors: true,
          opacityFrom: 0.2,
          opacityTo: 0.5,
          stops: [0, 50, 100],
          colorStops: [],
        },
      },
      colors: ["#fff"],
      xaxis: {
        categories: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ],
      },
      tooltip: {
        theme: "dark",
        fixed: {
          enabled: !1,
        },
        x: {
          show: !1,
        },
        y: {
          title: {
            formatter: function (e) {
              return "";
            },
          },
        },
        marker: {
          show: !1,
        },
      },
    };
    new ApexCharts(document.querySelector("#chart123"), e).render();

    // chart 7
    var options = {
      series: [
        {
          name: "Control Panel PR",
          data: [44, 55, 57, 56, 61, 58, 63],
        },
        {
          name: "Control Panel CPR",
          data: [76, 85, 101, 98, 87, 105, 91],
        },
        {
          name: "Test Panel PR",
          data: [36, 26, 45, 48, 52, 53, 41],
        },
        {
          name: "Test Panel CPR",
          data: [35, 41, 36, 26, 45, 48, 52],
        },
      ],
      chart: {
        foreColor: "rgba(255, 255, 255, 0.65)",
        type: "bar",
        height: 400,
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: "35%",
          endingShape: "rounded",
        },
      },
      dataLabels: {
        enabled: false,
      },
      stroke: {
        show: true,
        width: 2,
        colors: ["transparent"],
      },
      title: {
        text: "",
        align: "left",
        style: {
          fontSize: "14px",
        },
      },
      colors: [
        "rgba(226, 239, 222)",
        "rgba(241, 168, 134)",
        "rgba(64, 215, 255)",
        "rgba(17, 105, 255)",
      ],
      xaxis: {
        categories: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
      },
      yaxis: {
        title: {
          text: "Performance Ratio",
        },
      },
      fill: {
        opacity: 1,
      },
      grid: {
        show: true,
        borderColor: "rgba(255, 255, 255, 0.12)",
        strokeDashArray: 4,
      },
      tooltip: {
        theme: "dark",
      },
    };
    var chart = new ApexCharts(document.querySelector("#chart700"), options);
    chart.render();

    // chart 6 Battery Level
    /* 
    var options = {
      chart: {
        height: 325,
        type: "radialBar",
        toolbar: {
          show: false,
        },
      },
      plotOptions: {
        radialBar: {
          startAngle: -135,
          endAngle: 225,
          hollow: {
            //margin: 20,
            size: "80%",
            background: "transparent",
            image: undefined,
            imageOffsetX: 0,
            imageOffsetY: 0,
            position: "front",
            dropShadow: {
              enabled: true,
              top: 3,
              left: 0,
              blur: 4,
              opacity: 0.24,
            },
          },
          track: {
            background: "rgba(255, 255, 255, 0.12)",
            //strokeWidth: '67%',
            margin: 0, // margin is in pixels
            dropShadow: {
              enabled: true,
              top: -3,
              left: 0,
              blur: 4,
              opacity: 0.35,
            },
          },

          dataLabels: {
            showOn: "always",
            name: {
              offsetY: -10,
              show: false,
              color: "#fff",
              fontSize: "16px",
            },
            value: {
              formatter: function (val) {
                return val + "%";
              },
              color: "#fff",
              fontSize: "40px",
              show: true,
            },
          },
        },
      },
      fill: {
        type: "gradient",
        gradient: {
          shade: "light",
          type: "horizontal",
          shadeIntensity: 0.5,
          gradientToColors: ["#fff"],
          inverseColors: false,
          opacityFrom: 1,
          opacityTo: 1,
          stops: [0, 100],
        },
      },
      colors: ["#fff"],
      series: [horizontalData["batteryLevelData"][index - 1].toFixed(1)],
      stroke: {
        lineCap: "round",
      },
      labels: ["Median Ratio"],
    };

    chart6 = new ApexCharts(
      document.querySelector("#vacancies-status"),
      options
    );

    chart6.render();
 */

    // chart 14

    var options = {
      chart: {
        height: 225,
        type: "area",
        zoom: {
          enabled: false,
        },
        foreColor: "rgba(255, 255, 255, 0.65)",
        background: "rgba(54, 54, 54, 0.1) ",
        toolbar: {
          show: true,
        },
        sparkline: {
          enabled: false,
        },
      },
      plotOptions: {
        bar: {
          columnWidth: "10%",
          endingShape: "rounded",
          dataLabels: {
            position: "top", // top, center, bottom
          },
        },
      },
      dataLabels: {
        enabled: false,
      },
      stroke: {
        width: 2.5,
        curve: "smooth",
      },
      series: [
        {
          name: "Soiling Loss",
          data: [5, 10, 7, 8, 19, 20, 33],
        },
        {
          name: "Mass of Dust",
          data: last7MassOfDust,
        },
      ],

      xaxis: {
        type: "days",
        categories: last7DaysDust,
      },
      yaxis: [
        {
          seriesName: "Soiling Loss",
          axisTicks: {
            show: true,
          },
          axisBorder: {
            show: true,
          },
          title: {
            text: "Soiling Loss (%)",
          },
          axisTicks: {
            show: true,
          },
          labels: {
            show: true,
            formatter: function (val) {
              return parseFloat(val);
            },
          },
          min: 0,
          max: 100,
          tickAmount: 10,
        },
        {
          opposite: true,
          seriesName: "Mass of Dust",
          axisTicks: {
            show: true,
          },
          axisBorder: {
            show: true,
          },
          title: {
            text: "Mass of Dust (g)",
          },
          axisTicks: {
            show: true,
          },
          labels: {
            show: true,
            formatter: function (val) {
              return parseFloat(val).toFixed(1);
            },
          },
        },
      ],
      fill: {
        type: "gradient",
        gradient: {
          shade: "light",
          gradientToColors: [
            "rgba(255, 255, 255, 0.60)",
            "rgba(255, 255, 255, 0.30)",
          ],
          shadeIntensity: 1,
          type: "vertical",
          opacityFrom: 1,
          opacityTo: 1,
          stops: [0, 80, 100],
        },
      },
      colors: ["rgba(255, 255, 255, 0.60)", "rgba(255, 255, 255, 0.30)"],
      legend: {
        show: !0,
        position: "top",
        horizontalAlign: "left",
        offsetX: -20,
        fontSize: "12px",
        markers: {
          radius: 50,
          width: 10,
          height: 10,
        },
      },
      grid: {
        show: true,
        borderColor: "rgba(255, 255, 255, 0.12)",
      },
      tooltip: {
        theme: "dark",
        x: {
          format: "dd/MM/yy HH:mm",
        },
      },
      responsive: [
        {
          breakpoint: 480,
          options: {
            chart: {
              height: 300,
            },
            legend: {
              offsetX: -20,
              fontSize: "12px",
            },
          },
        },
      ],
    };

    chart14 = new ApexCharts(document.querySelector("#soiling-dust"), options);

    chart14.render();

    // console.log(last7Days);

    // chart 14

    var options = {
      chart: {
        height: 225,
        type: "bar",
        zoom: {
          enabled: false,
        },
        foreColor: "rgba(255, 255, 255, 0.65)",
        background: "rgba(54, 54, 54, 0.1) ",
        toolbar: {
          show: true,
        },
        sparkline: {
          enabled: false,
        },
      },
      plotOptions: {
        bar: {
          columnWidth: "45%",
          endingShape: "rounded",
          dataLabels: {
            position: "top", // top, center, bottom
          },
        },
      },
      dataLabels: {
        enabled: false,
      },
      stroke: {
        width: 2.5,
        curve: "smooth",
      },
      series: [
        {
          name: "Control Panel",
          data: last7DaysControlPower,
        },
        {
          name: "Test Panel",
          data: last7DaysTestPower,
        },
      ],

      xaxis: {
        type: "days",
        categories: last7DaysPower,
      },
      yaxis: [
        {
          seriesName: "Energy(kWh/day)",
          axisTicks: {
            show: true,
          },
          axisBorder: {
            show: true,
          },
          title: {
            text: "Energy(kWh/day)",
          },
          axisTicks: {
            show: true,
          },
          labels: {
            show: true,
            formatter: function (val) {
              return parseFloat(val);
            },
          },
        },
      ],
      fill: {
        type: "gradient",
        gradient: {
          shade: "light",
          gradientToColors: [
            "rgba(255, 255, 255, 0.60)",
            "rgba(255, 255, 255, 0.30)",
          ],
          shadeIntensity: 1,
          type: "vertical",
          opacityFrom: 1,
          opacityTo: 1,
          stops: [0, 80, 100],
        },
      },
      colors: ["rgba(255, 255, 255, 0.60)", "rgba(255, 255, 255, 0.30)"],
      legend: {
        show: !0,
        position: "top",
        horizontalAlign: "left",
        offsetX: -20,
        fontSize: "12px",
        markers: {
          radius: 50,
          width: 10,
          height: 10,
        },
      },
      grid: {
        show: true,
        borderColor: "rgba(255, 255, 255, 0.12)",
      },
      tooltip: {
        theme: "dark",
        x: {
          format: "dd/MM/yy HH:mm",
        },
      },
      responsive: [
        {
          breakpoint: 480,
          options: {
            chart: {
              height: 300,
            },
            legend: {
              offsetX: -20,
              fontSize: "12px",
            },
          },
        },
      ],
    };

    chart15 = new ApexCharts(document.querySelector("#dailyPowerGen"), options);

    chart15.render();

    var options = {
      chart: {
        height: 225,
        type: "area",
        zoom: {
          enabled: false,
        },
        foreColor: "rgba(255, 255, 255, 0.65)",
        background: "rgba(54, 54, 54, 0.1) ",
        toolbar: {
          show: true,
        },
        sparkline: {
          enabled: false,
        },
      },
      plotOptions: {
        bar: {
          columnWidth: "10%",
          endingShape: "rounded",
          dataLabels: {
            position: "top", // top, center, bottom
          },
        },
      },
      dataLabels: {
        enabled: false,
      },
      stroke: {
        width: 2.5,
        curve: "smooth",
      },
      series: [
        {
          name: "Control",
          data: hourlyControlCurrentAvg,
        },
        {
          name: "Test",
          data: hourlyTestCurrentAvg,
        },
      ],

      xaxis: {
        type: "days",
        categories: hourlyAvgHours,
        title: {
          text: "Hour of Day",
        },
      },
      yaxis: [
        {
          seriesName: "Control",
          axisTicks: {
            show: true,
          },
          axisBorder: {
            show: true,
          },
          title: {
            text: "Current (A)",
          },
          axisTicks: {
            show: true,
          },
          labels: {
            show: true,
            formatter: function (val) {
              return parseFloat(val);
            },
          },
        },
      ],
      fill: {
        type: "gradient",
        gradient: {
          shade: "light",
          gradientToColors: [
            "rgba(255, 255, 255, 0.60)",
            "rgba(255, 255, 255, 0.30)",
          ],
          shadeIntensity: 1,
          type: "vertical",
          opacityFrom: 1,
          opacityTo: 1,
          stops: [0, 80, 100],
        },
      },
      colors: ["rgba(255, 255, 255, 0.60)", "rgba(255, 255, 255, 0.30)"],
      legend: {
        show: !0,
        position: "top",
        horizontalAlign: "left",
        offsetX: -20,
        fontSize: "12px",
        markers: {
          radius: 50,
          width: 10,
          height: 10,
        },
      },
      grid: {
        show: true,
        borderColor: "rgba(255, 255, 255, 0.12)",
      },
      tooltip: {
        theme: "dark",
        x: {
          format: "dd/MM/yy HH:mm",
        },
      },
      responsive: [
        {
          breakpoint: 480,
          options: {
            chart: {
              height: 300,
            },
            legend: {
              offsetX: -20,
              fontSize: "12px",
            },
          },
        },
      ],
    };

    chart16 = new ApexCharts(document.querySelector("#currentplot"), options);

    chart16.render();

    var options = {
      chart: {
        height: 225,
        type: "area",
        zoom: {
          enabled: false,
        },
        foreColor: "rgba(255, 255, 255, 0.65)",
        background: "rgba(54, 54, 54, 0.1) ",
        toolbar: {
          show: true,
        },
        sparkline: {
          enabled: false,
        },
      },
      plotOptions: {
        bar: {
          columnWidth: "10%",
          endingShape: "rounded",
          dataLabels: {
            position: "top", // top, center, bottom
          },
        },
      },
      dataLabels: {
        enabled: false,
      },
      stroke: {
        width: 2.5,
        curve: "smooth",
      },
      series: [
        {
          name: "Control",
          data: hourlyControlPowerAvg,
        },
        {
          name: "Test",
          data: hourlyTestPowerAvg,
        },
      ],

      xaxis: {
        type: "days",
        categories: hourlyAvgHours,
        title: {
          text: "Hour of Day",
        },
      },
      yaxis: [
        {
          seriesName: "Control",
          axisTicks: {
            show: true,
          },
          axisBorder: {
            show: true,
          },
          title: {
            text: "Power (W)",
          },
          axisTicks: {
            show: true,
          },
          labels: {
            show: true,
            formatter: function (val) {
              return parseFloat(val);
            },
          },
        },
      ],
      fill: {
        type: "gradient",
        gradient: {
          shade: "light",
          gradientToColors: [
            "rgba(255, 255, 255, 0.60)",
            "rgba(255, 255, 255, 0.30)",
          ],
          shadeIntensity: 1,
          type: "vertical",
          opacityFrom: 1,
          opacityTo: 1,
          stops: [0, 80, 100],
        },
      },
      colors: ["rgba(255, 255, 255, 0.60)", "rgba(255, 255, 255, 0.30)"],
      legend: {
        show: !0,
        position: "top",
        horizontalAlign: "left",
        offsetX: -20,
        fontSize: "12px",
        markers: {
          radius: 50,
          width: 10,
          height: 10,
        },
      },
      grid: {
        show: true,
        borderColor: "rgba(255, 255, 255, 0.12)",
      },
      tooltip: {
        theme: "dark",
        x: {
          format: "dd/MM/yy HH:mm",
        },
      },
      responsive: [
        {
          breakpoint: 480,
          options: {
            chart: {
              height: 300,
            },
            legend: {
              offsetX: -20,
              fontSize: "12px",
            },
          },
        },
      ],
    };

    chart17 = new ApexCharts(document.querySelector("#powerplot"), options);

    chart17.render();
  },
  error: function () {
    console.log("error");
  },
});
