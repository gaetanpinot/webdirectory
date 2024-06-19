import 'package:webdirectoryapp/models/fonction.dart';
import 'package:webdirectoryapp/models/telephone.dart';

import 'service.dart';

class Personne {
  final int id;
  final String nom;
  final String prenom;
  final List<Service> service;
  late String imageUrl;
  final String numBur;
  final String email;
  final List<Telephone> numTel;
  final List<Fonction> fonction;

  Personne({
    required this.id,
    required this.nom,
    required this.prenom,
    required this.service,
    required this.imageUrl,
    required this.numBur,
    required this.email,
    required this.numTel,
    required this.fonction,
  });

  factory Personne.fromJson(Map<String, dynamic> json) {
    return Personne(
      id: json['id'],
      nom: json['nom'],
      prenom: json['prenom'],
      service: [Service.fromJson(json['services'])],
      imageUrl: json['links']['detail'],
      numBur: json['numBur'],
      email: json['email'],
      numTel: [Telephone.fromJson(json['telephones'])],
      fonction: [Fonction.fromJson(json['fonction'])],
    );
  }

  String getNom() {
    return nom;
  }

  getPrenom() {
    return prenom;
  }
}
