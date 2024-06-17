import 'package:webdirectoryapp/models/service.dart';

class Detail {
  final int id;
  final String nom;
  final String prenom;
  final Service service;
  late String personneUrl;

  Detail({
    required this.id,
    required this.nom,
    required this.prenom,
    required this.service,
    String? personneUrl,
  }) {
    this.personneUrl = personneUrl ?? '';
  }

  factory Detail.fromJson(Map<String, dynamic> json) {
    return Detail(
        id: json['id'],
        nom: json['nom'],
        prenom: json['prenom'],
        service: Service.fromJson(json['service']),
        personneUrl: json['links']['detail']);
  }

  String getNom() {
    return nom;
  }

  getPrenom() {
    return prenom;
  }

  getServiceLibelle() {
    return service.libelle;
  }

  getServiceUrl() {
    return service.serviceUrl;
  }

  getPersonneUrl() {
    return personneUrl;
  }

  getId() {
    return id;
  }
}
