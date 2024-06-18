class Telephone {
  final String tel;

  Telephone({
    required this.tel,
  });

  factory Telephone.fromJson(Map<String, dynamic> json) {
    return Telephone(
      tel: json['telephones'],
    );
  }
}
