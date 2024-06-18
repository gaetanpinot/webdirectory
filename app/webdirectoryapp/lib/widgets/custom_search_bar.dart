import 'package:flutter/material.dart';

class CustomSearchBar extends StatelessWidget {
  final TextEditingController controller;
  final String hintText;
  final Function(String) onSearchChanged; // Callback function for text changes

  const CustomSearchBar({
    super.key,
    required this.controller,
    required this.hintText,
    required this.onSearchChanged, // Require the callback function in the constructor
  });

  @override
  Widget build(BuildContext context) {
    return TextField(
      controller: controller,
      decoration: InputDecoration(
        prefixIcon: const Icon(Icons.search),
        hintText: hintText,
      ),
      onChanged: onSearchChanged,
    );
  }
}
