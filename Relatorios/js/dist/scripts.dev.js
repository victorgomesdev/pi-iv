"use strict";

var _elements = {
  loading: document.querySelector(".loading"),
  "switch": document.querySelector(".switch__track"),
  stateSelectToggle: document.querySelector(".state-select-toggle"),
  selectOptions: document.querySelectorAll(".state-select-list__item"),
  selectList: document.querySelector(".state-select-list"),
  selectToggleIcon: document.querySelector(".state-select-toggle__icon"),
  selectSearchBox: document.querySelector(".state-select-list__search"),
  selectStateSelected: document.querySelector(".state-select-toggle__label"),
  confirmed: document.querySelector(".info__total--confirmed"),
  deaths: document.querySelector(".info__total--deaths"),
  deathsDescription: document.querySelector(".data-box__description"),
  canceladas: document.querySelector(".info__total--canceladas"),
  faltas: document.querySelector(".info__total--faltas")
};
var _data = {
  id: "brasil=true",
  vaccinatedInfo: undefined,
  vaccinated: undefined,
  confirmed: undefined,
  deaths: undefined
};
var _charts = {};

_elements.stateSelectToggle.addEventListener("click", function () {
  _elements.selectToggleIcon.classList.toggle("state-select-toggle__icon--rotate");

  _elements.selectList.classList.toggle("state-select-list--show");
});

_elements.selectOptions.forEach(function (item) {
  item.addEventListener("click", function () {
    _elements.selectStateSelected.innerText = item.innerText;
  });
});

_elements.selectSearchBox.addEventListener("keyup", function (e) {});

var request = function request(api, id) {};

var loadData = function loadData(id) {};

var createBasicChart = function createBasicChart(element, config) {};

var createDonutChart = function createDonutChart(element) {};

var createStackedColumnsChart = function createStackedColumnsChart(element) {};

var createCharts = function createCharts() {};

var updateCards = function updateCards() {};

var updateCharts = function updateCharts() {};

var getChartOptions = function getChartOptions(series, labels, colors) {};

var getDonutChartOptions = function getDonutChartOptions(value, name, colors) {};

loadData(_data.id);
createCharts();
//# sourceMappingURL=scripts.dev.js.map
