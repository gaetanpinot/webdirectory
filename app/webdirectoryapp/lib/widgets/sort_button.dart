import 'package:flutter/material.dart';

class SortButton extends StatelessWidget {
  final VoidCallback onPressed;
  final bool isAscending;

  SortButton({required this.onPressed, required this.isAscending});

  @override
  Widget build(BuildContext context) {
    return IconButton(
      icon: Icon(isAscending ? Icons.arrow_upward : Icons.arrow_downward), 
      onPressed: onPressed, 
    );
  }
}
