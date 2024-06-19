import 'package:dio/dio.dart';
import 'package:webdirectoryapp/models/detail.dart';
import 'package:webdirectoryapp/models/fonction.dart';
import 'package:webdirectoryapp/models/personne.dart';
import 'package:webdirectoryapp/models/telephone.dart';

import '../models/service.dart';

class ApiService {
  final baseUrl = 'http://localhost:44000';
  final Dio _dio = Dio();
  Future<Personne> getDetailPersonne(String url) async {
    try {
      final Personne liste;
      final response = await _dio.get(baseUrl + url);
      if (response.statusCode == 200) {
        var telephone = response.data['data']['personne']['telephones'] ?? "";
        var telephoneList = (telephone as List<dynamic>)
            .map((item) => item.toString())
            .toList();
        var fonction = response.data['data']['personne']['fonctions'] ?? "";
        var fonctionList = (fonction as List<dynamic>)
            .map((item) => Fonction.fromJson(item))
            .toList();
        var personne = response.data['data']['personne'];
        var service = response.data['data']['personne']['services'] ?? "";
        var serviceList = (service as List<dynamic>)
            .map((item) => Service.fromJson(item))
            .toList();
        Personne personneMap = Personne(
          id: personne['id'],
          nom: personne['nom'],
          prenom: personne['prenom'],
          email: personne['mail'],
          numBur: personne['num_bureau'],
          imageUrl: personne['url_img'] ?? "",
          service: serviceList,
          numTel: telephoneList.map((e) => Telephone(tel: e)).toList(),
          fonction: fonctionList,
        );
        liste = personneMap;
        return liste;
      } else {
        throw Exception('Failed to load detail: ${response.statusCode}');
      }
    } catch (e) {
      throw Exception('Error fetching detail: $e');
    }
  }

  Future<List<Detail>> getNames() async {
    String url = 'http://localhost:44000/api/personnes';

    try {
      final response = await _dio.get(url);
      if (response.statusCode == 200) {
        List<Detail> personnesList = [];

        var data = response.data['data']['personnes'];
        for (int i = 0; i < data.length; i++) {
          var personne = data[i];
          if (personne['services'].isEmpty) {
            personne['services'].add({'libelle': ''});
          }
          var service = response.data['data']['personnes'][i]['services'] ?? "";

          var serviceList = (service as List<dynamic>)
              .map((item) => Service.fromJson(item))
              .toList();
          Detail personneMap = Detail(
            id: personne['id'],
            nom: personne['nom'],
            prenom: personne['prenom'],
            service: serviceList,
            imgUrl: personne['url_img'] ?? "",
            personneUrl: personne['links']['detail'],
          );
          personnesList.add(personneMap);
        }
        return personnesList;
      } else {
        throw Exception('Failed to load names: ${response.statusCode}');
      }
    } catch (e) {
      throw Exception('Error fetching names: $e');
    }
  }

  Future<List<Service>> getServices() async {
    String url = 'http://localhost:44000/api/services';

    try {
      final response = await _dio.get(url);
      if (response.statusCode == 200) {
        List<Service> servicesList = [];
        var aucunService = Service(libelle: "Aucun", id: 0, serviceUrl: "");
        servicesList.add(aucunService);

        var data = response.data['data']['services'];

        for (var service in data) {
          Service serviceMap = Service(
            id: service['id'],
            libelle: service['libelle'],
            serviceUrl: service['links']['detail'],
          );
          servicesList.add(serviceMap);
        }
        return servicesList;
      } else {
        throw Exception('Failed to load services: ${response.statusCode}');
      }
    } catch (e) {
      throw Exception('Error fetching services: $e');
    }
  }
}
