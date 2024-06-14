import 'package:dio/dio.dart';
import 'package:webdirectoryapp/models/personne.dart';

import '../models/service.dart';

class ApiService {
  final Dio _dio = Dio();

  Future<List<Personne>> getNames() async {
    String url = 'http://localhost:44000/api/personnes';

    try {
      final response = await _dio.get(url);
      //print(response.data['data']['personnes']);
      if (response.statusCode == 200) {
        List<Personne> personnesList = [];

        var data = response.data['data']['personnes'];

        for (var personne in data) {
          if (personne['service'].isEmpty) {
            personne['service'].add({'libelle': ''});
          }

          var service = personne['service'][0] ?? "";
          Personne personneMap = Personne(
            id: personne['id'],
            nom: personne['nom'],
            prenom: personne['prenom'],
            service: Service(libelle: service['libelle'], id: service['id']),
            imageUrl: personne['links']['detail'],
          );
          personnesList.add(personneMap);
        }
        print(personnesList);
        return personnesList;
      } else {
        throw Exception('Failed to load names: ${response.statusCode}');
      }
    } catch (e) {
      throw Exception('Error fetching names: $e');
    }
  }
}
