import 'package:dio/dio.dart';

class ApiService {
  final Dio _dio = Dio();

  Future<List<Map<String, dynamic>>> getNames() async {
    String url = 'http://localhost:44000/api/personnes';

    try {
      final response = await _dio.get(url);
      //print(response.data['data']['personnes']);
      if (response.statusCode == 200) {
        List<Map<String, dynamic>> personnesList = [];

        var data = response.data['data']['personnes'];

        for (var personne in data) {
          if (personne['service'].isEmpty)
            personne['service'].add({'libelle': ''});

          var service = personne['service'][0] ?? "";
          Map<String, dynamic> personneMap = {
            'id': personne['id'] ?? 0,
            'nom': personne['nom'] ?? "",
            'prenom': personne['prenom'] ?? "",
            'serviceLibelle': service['libelle'] ?? "",
          };
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
}
