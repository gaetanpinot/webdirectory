import 'package:flutter/material.dart';
import 'package:webdirectoryapp/models/detail.dart';
import 'package:webdirectoryapp/models/personne.dart';
import 'package:webdirectoryapp/models/service.dart';
import '../api/api_service.dart';
import '../screens/detail_screen.dart';
import '../widgets/user_list.dart';
import '../widgets/custom_search_bar.dart';
import '../widgets/sort_button.dart';

class HomeScreen extends StatefulWidget {
  const HomeScreen({super.key});

  @override
  _HomeScreenState createState() => _HomeScreenState();
}

class _HomeScreenState extends State<HomeScreen> {
  final TextEditingController _filter = TextEditingController();
  final ApiService _apiService = ApiService();
  String _searchText = "";
  List<Detail> names = [];
  List<Detail> filteredNames = [];
  List<Service> services = [];
  Icon _searchIcon = const Icon(Icons.search);
  Widget _appBarTitle = const Text('WebDirectory');
  bool _isAscending = true;
  String? _selectedService;

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
    _getServices();
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

  void filterByService(String? selectedService) {
    setState(() {
      _selectedService = selectedService;
    });
    _updateFilter(); // Appliquer les filtres après la sélection d'un service
  }

  void _getServices() async {
    try {
      final fetchedServices = await _apiService.getServices();
      setState(() {
        services = fetchedServices;
      });
    } catch (e) {
      debugPrint("Erreur lors de la récupération des services : $e");
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

  void _updateFilter() {
    setState(() {
      // Filtrer d'abord par service si un service est sélectionné
      List<Detail> tempFilteredNames = _selectedService != null &&
              _selectedService!.isNotEmpty &&
              _selectedService != "Aucun"
          ? names
              .where(
                  (Detail detail) => detail.service.libelle == _selectedService)
              .toList()
          : List.from(names);

      // Ensuite, filtrer par texte de recherche si le texte n'est pas vide
      if (_searchText.isNotEmpty) {
        tempFilteredNames = tempFilteredNames.where((Detail detail) {
          return detail
              .getNom()
              .toLowerCase()
              .contains(_searchText.toLowerCase());
        }).toList();
      }

      // Mettre à jour la liste filtrée
      filteredNames = tempFilteredNames;
    });
  }

  Widget buildServiceDropdown() {
    return DropdownButton<String>(
      value: _selectedService,
      hint: const Text("Select Service"),
      onChanged: (String? newValue) {
        setState(() {
          _selectedService = newValue;
          filterByService(_selectedService);
        });
      },
      items: services.map<DropdownMenuItem<String>>((Service service) {
        return DropdownMenuItem<String>(
          value: service.libelle,
          child: Text(service.libelle),
        );
      }).toList(),
    );
  }

  void _sortNames() {
    setState(() {
      if (_isAscending) {
        filteredNames.sort((a, b) => b.getNom().compareTo(a.getNom()));
      } else {
        filteredNames.sort((a, b) => a.getNom().compareTo(b.getNom()));
      }
    });
  }

  void _toggleSortOrder() {
    setState(() {
      _isAscending = !_isAscending;
      _sortNames();
    });
  }

  Future<Personne> getPers(String url) async {
    Personne personne;
    personne = await _apiService.getDetailPersonne(url);
    return personne;
  }

  Widget _buildList() {
    return UserList(
      filteredNames: filteredNames,
      onTap: (index) {
        Navigator.push(
          context,
          MaterialPageRoute(
            builder: (context) => _buildPersonneDetailPage(
                filteredNames[index].getPersonneUrl(), index),
          ),
        );
      },
    );
  }

  Widget _buildPersonneDetailPage(String url, int index) {
    return FutureBuilder<Personne>(
      future: getPers(url),
      builder: (context, snapshot) {
        if (snapshot.connectionState == ConnectionState.waiting) {
          return const CircularProgressIndicator();
        } else if (snapshot.hasError) {
          return Scaffold(
            appBar: AppBar(title: const Text("Error")),
            body: Center(
              child: Text('Error: ${snapshot.error.toString()}'),
            ),
          );
        } else if (snapshot.hasData) {
          return DetailScreen(personne: snapshot.data);
        } else {
          return const Scaffold(
            body: Center(
              child: Text("No data available"),
            ),
          );
        }
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
          onSearchChanged: (text) {
            filterByService(_selectedService);
          },
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
      body: Column(
        children: [
          buildServiceDropdown(),
          Expanded(
            child: _buildList(),
          ),
        ],
      ),
    );
  }
}
