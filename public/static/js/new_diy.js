var monApp = angular.module('newDiy', []);
monApp.controller('newDiyCtrl', function ($scope, $http) {

	// Declare variables :
	var baseCorrectif, dosageFab;
	$scope.baseLegend = "50 % PG / 50 % VG";
	$scope.decimal = '[1-5]?[0-9]*(\.|\,)?[0-9]';
	$scope.entier = '[1-9]?[0-9]*';

	// Init the values of the form if submitted before :
	$scope.lastSubmit = function (datasFromRequest, json_aromes, json_bases) {
		var dateRecette = new Date().toLocaleDateString();
		$scope.formateDate(dateRecette, "recet");
		if (datasFromRequest.length > 2) {
			datasFromRequest = JSON.parse(datasFromRequest);
			for (key in datasFromRequest["recette"]) {
				if (datasFromRequest["recette"][key] != undefined) {
					if (key == "idBase") {
						$scope.base_id = parseInt(datasFromRequest["recette"][key]);
						for (var i = 0; i < json_bases.length; i++) {
							if ($scope.base_id == json_bases[i]['base_id']) {
								baseCorrectif = json_bases[i]['base_correctif'];
								$scope.baseLegend = json_bases[i]['base_pg'] + " % PG / " + (100 - json_bases[i]['base_pg']) + " % VG ";
							}
						}
					}
					if (key == "qteTot") $scope.qte_tot = parseInt(datasFromRequest["recette"][key]);
					if (key == "qteBas") $scope.qte_bas = parseFloat(datasFromRequest["recette"][key]);
					if (key == "qteAro") $scope.qte_aro = parseFloat(datasFromRequest["recette"][key]);
					if (key == "datStee") {
						var strDate = datasFromRequest["recette"][key]["day"] + "/" + datasFromRequest["recette"][key]["month"] + "/" + datasFromRequest["recette"][key]["year"];
						$scope.formateDate(strDate, "stee");
					}
					if (key == "aromeRecettes" && datasFromRequest["recette"]["aromeRecettes"][0]["idAro"] != undefined) {
						$scope.arome_id = datasFromRequest["recette"]["aromeRecettes"][0]["idAro"];
						for (var i = 0; i < json_aromes.length; i++) {
							if ($scope.arome_id == json_aromes[i]['aro_id']) {
								dosageFab = json_aromes[i]['aro_dos_fab'];
								$scope.aro_nb_steep = json_aromes[i]['aro_nb_steep'];
							}
						}
					}
					if (key == "aromeRecettes" && datasFromRequest["recette"]["aromeRecettes"][0]["dosAro"] != undefined) $scope.dosage = datasFromRequest["recette"]["aromeRecettes"][0]["dosAro"];
				}
			}
		}
	}

	// Get the 'dosage fabricant' and the 'nombre de jours de steep' of the selected 'arome':
	$scope.selectedArome = function (dataAromesJson) {
		if ($scope.arome_id) {
			for (var i = 0; i < dataAromesJson.length; i++) {
				if ($scope.arome_id == dataAromesJson[i]['aro_id']) {
					dosageFab = dataAromesJson[i]['aro_dos_fab'];
					$scope.dosage = dataAromesJson[i]['aro_dos_fab'];
					$scope.aro_nb_steep = dataAromesJson[i]['aro_nb_steep'];
					$scope.calculateSteep();
					$scope.calculateDosage();
					$scope.calculateNewDiy();
				}
			}
		}
	}

	// Get the 'correctif' of the selected 'base':
	$scope.selectedBase = function (dataBasesJson) {
		if ($scope.base_id) {
			for (var i = 0; i < dataBasesJson.length; i++) {
				if ($scope.base_id == dataBasesJson[i]['base_id']) {
					baseCorrectif = dataBasesJson[i]['base_correctif'];
					$scope.baseLegend = dataBasesJson[i]['base_pg'] + " % PG / " + (100 - dataBasesJson[i]['base_pg']) + " % VG ";
					if ($scope.dosage) $scope.calculateDosage();
					$scope.calculateNewDiy();
				}
			}
		}
	}

	// Init the 'correctif' of the default 'base' :
	$scope.deleteCorr = function () {
		if ($scope.dosage) {
			correctif = 1;
		}
	}

	// Calculate the different values of the 'recette' :
	$scope.calculateNewDiy = function () {
		if (this.arome_id && this.dosage && this.base_id && this.qte_tot) {
			this.dosage = parseFloat(($scope.dosage).toString().replace(",", "."));
			this.qte_aro = this.qte_tot * (this.dosage / 100);
			this.qte_aro = (Math.round(this.qte_aro * 10)) / 10;
			this.qte_bas = this.qte_tot - this.qte_aro;
		}
	}

	// Calculate the date of steep of the 'recette' :
	$scope.calculateSteep = function () {
		var prevu = new Date().getTime() + (86400000 * $scope.aro_nb_steep);
		prevu = new Date(prevu).toLocaleDateString();
		$scope.formateDate(prevu, "stee");
	}

	// Actualize the 'dosage' of the 'recette' :
	$scope.calculateDosage = function () {
		if ($scope.dosage && $scope.base_id) $scope.dosage = (Math.round(baseCorrectif * dosageFab * 10)) / 10;
	}

	// Transform JS "new Date().toLocaleDateString()" for Symfony DateTimeType validation :
	$scope.formateDate = function (jsDate, attribute) {
		jsDate = jsDate.split("/");
		if (attribute == "stee") {
			$scope.dat_stee_day = jsDate[0];
			$scope.dat_stee_month = jsDate[1];
			$scope.dat_stee_year = jsDate[2];
		}
		if (attribute == "recet") {
			$scope.dat_recet_day = jsDate[0];
			$scope.dat_recet_month = jsDate[1];
			$scope.dat_recet_year = jsDate[2];
		}
	}
});

