import 'service.dart';

class Personne {
  final int id;
  final String nom;
  final String prenom;
  final Service service;
  late String imageUrl;
  final String numBur;
  final String email;

  Personne({
    required this.id,
    required this.nom,
    required this.prenom,
    required this.service,
    required this.imageUrl,
    required this.numBur,
    required this.email,
  });

  factory Personne.fromJson(Map<String, dynamic> json) {
    return Personne(
      id: json['id'],
      nom: json['nom'],
      prenom: json['prenom'],
      service: Service.fromJson(json['service']),
      imageUrl: json['links']['detail'],
      numBur: json['numBur'],
      email: json['email'],
    );
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
}
