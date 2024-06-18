import 'package:dio/dio.dart';
import 'package:webdirectoryapp/models/detail.dart';
import 'package:webdirectoryapp/models/personne.dart';

import '../models/service.dart';

class ApiService {
  final baseUrl = 'http://localhost:44000';
  final Dio _dio = Dio();
  Future<Personne> getDetailPersonne(String url) async {
    try {
      final Personne liste;
      final response = await _dio.get(baseUrl + url);
      if (response.statusCode == 200) {
        var personne = response.data['data']['personne'];
        var service = response.data['data']['personne']['service'] ?? "";
        Personne personneMap = Personne(
          id: personne['id'],
          nom: personne['nom'],
          prenom: personne['prenom'],
          email: personne['mail'],
          numBur: personne['num_bureau'],
          imageUrl: personne['url_img'] ?? "",
          service: Service(
              libelle: service['libelle'],
              id: service['id'],
              serviceUrl: service['links']['detail']),
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
      //print(response.data['data']['personnes']);
      if (response.statusCode == 200) {
        List<Detail> personnesList = [];

        var data = response.data['data']['personnes'];

        for (var personne in data) {
          if (personne['service'].isEmpty) {
            personne['service'].add({'libelle': ''});
          }

          var service = personne['service'][0] ?? "";
          Detail personneMap = Detail(
            id: personne['id'],
            nom: personne['nom'],
            prenom: personne['prenom'],
            imgUrl: personne['url_img'] ?? "",
            service: Service(
                libelle: service['libelle'],
                id: service['id'],
                serviceUrl: service['links']['detail']),
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
