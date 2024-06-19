class Service {
  final String libelle;
  final int id;
  final String serviceUrl;
  Service({required this.libelle, required this.id, required this.serviceUrl});

  factory Service.fromJson(Map<String, dynamic> json) {
    return Service(
        id: json['id'],
        libelle: json['libelle'],
        serviceUrl: json['links']['detail']);
  }

  getLibelle() {
    return libelle;
  }
}
