import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:frontend/cubits/cubits.dart';

class TemporaryScreen extends StatelessWidget {
  const TemporaryScreen({super.key});

  static const routeName = "welcome";

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Welcome to JAVA app'),
        actions: [
          IconButton(
              onPressed: () {
                context.read<LoginUserCubit>().signOut();
                Navigator.of(context)
                    .pushNamedAndRemoveUntil('login', (route) => false);
              },
              icon: const Icon(Icons.logout_rounded))
        ],
      ),
      body: const Center(
        child: Text(
          'Welcome to JAVA app',
          style: TextStyle(fontSize: 24),
        ),
      ),
    );
  }
}
