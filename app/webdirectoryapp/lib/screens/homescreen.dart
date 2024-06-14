import 'package:flutter/material.dart';
import '../api/api_service.dart';
import '../models/personne.dart';
import '../screens/detail_screen.dart';
import '../widgets/user_list.dart';
import '../widgets/custom_search_bar.dart';
import '../widgets/sort_button.dart';

class HomeScreen extends StatefulWidget {
  @override
  _HomeScreenState createState() => _HomeScreenState();
}

class _HomeScreenState extends State<HomeScreen> {
  final TextEditingController _filter = TextEditingController();
  final ApiService _apiService = ApiService();
  String _searchText = "";
  List<Personne> names = [];
  List<Personne> filteredNames = [];
  Icon _searchIcon = const Icon(Icons.search);
  Widget _appBarTitle = const Text('WebDirectory');
  bool _isAscending = true;

  _HomeScreenState() {
    _filter.addListener(() {
      if (_filter.text.isEmpty) {
        setState(() {
          _searchText = "";
          filteredNames = names;
        });
      } else {
        setState(() {
          _searchText = _filter.text;
          _filterNames();
        });
      }
    });
  }

  @override
  void initState() {
    _getNames();
    super.initState();
  }

  void _getNames() async {
    try {
      final fetchedNames = await _apiService.getNames();
      setState(() {
        names = fetchedNames;
        filteredNames = names;
      });
    } catch (e) {
      debugPrint("Erreur lors de la récupération des noms : $e");
    }
  }

  void _filterNames() {
    if (_searchText.isNotEmpty) {
      setState(() {
        filteredNames = names.where((name) {
          return name
              .getNom()
              .toLowerCase()
              .contains(_searchText.toLowerCase());
        }).toList();
        _sortNames();
      });
    }
  }

  void _sortNames() {
    setState(() {
      if (_isAscending) {
        filteredNames.sort((a, b) => a.getNom().compareTo(b.getNom()));
      } else {
        filteredNames.sort((a, b) => b.getNom().compareTo(a.getNom()));
      }
    });
  }

  void _toggleSortOrder() {
    setState(() {
      _isAscending = !_isAscending;
      _sortNames();
    });
  }

  Widget _buildList() {
    return UserList(
      filteredNames: filteredNames,
      onTap: (index) {
        Navigator.push(
          context,
          MaterialPageRoute(
            builder: (context) => DetailScreen(
              name: filteredNames[index].getNom(),
              prenom: filteredNames[index].getPrenom(),
              serviceLibelle: filteredNames[index]
                  .getServiceLibelle(), // Assurez-vous de récupérer correctement le libellé du service
            ),
          ),
        );
      },
    );
  }

  void _searchPressed() {
    setState(() {
      if (_searchIcon.icon == Icons.search) {
        _searchIcon = const Icon(Icons.close);
        _appBarTitle = CustomSearchBar(
          controller: _filter,
          hintText: 'Search...',
        );
      } else {
        _searchIcon = const Icon(Icons.search);
        _appBarTitle = const Text('WebDirectory');
        filteredNames = names;
        _filter.clear();
      }
    });
  }

  PreferredSizeWidget _buildAppBar(BuildContext context) {
    return AppBar(
      centerTitle: true,
      title: _appBarTitle,
      actions: [
        IconButton(
          icon: _searchIcon,
          onPressed: _searchPressed,
        ),
        SortButton(
          onPressed: _toggleSortOrder,
          isAscending: _isAscending,
        ),
      ],
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: _buildAppBar(context),
      body: _buildList(),
    );
  }
}
