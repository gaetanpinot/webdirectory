class Service {
  final String libelle;
  final int id;
  final String serviceUrl;
  Service({required this.libelle, required this.id, required this.serviceUrl});

  factory Service.fromJson(Map<String, dynamic> json) {
    return Service(
        libelle: json['libelle'],
        id: json['id'],
        serviceUrl: json['links']['detail']);
  }
}
