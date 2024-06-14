import 'service.dart';

class Personne {
  final int id;
  final String nom;
  final String prenom;
  final Service service;
  late String imageUrl;

  Personne({
    required this.id,
    required this.nom,
    required this.prenom,
    required this.service,
    String? imageUrl,
  }) {
    this.imageUrl = imageUrl ?? '';
  }

  factory Personne.fromJson(Map<String, dynamic> json) {
    return Personne(
        id: json['id'],
        nom: json['nom'],
        prenom: json['prenom'],
        service: Service.fromJson(json['service']),
        imageUrl: json['links']['detail']);
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

  getUrl() {
    return imageUrl;
  }
}
