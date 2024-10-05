import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:frontend/blocs/blocs.dart';
import 'package:frontend/cubits/cubits.dart';
import 'package:frontend/screens/login_screen/login_screen.dart';

class TemporaryScreen extends StatelessWidget {
  const TemporaryScreen({super.key});

  static const routeName = "welcome";

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Welcome to JAVA app'),
        actions: [
          BlocConsumer<AuthBloc, AuthState>(
            listener: (context, state) {
              if (!state.isAuthenticated) {
                Navigator.of(context)
                    .pushReplacementNamed(LoginScreen.routeName);
              }
            },
            builder: (context, state) {
              return IconButton(
                  onPressed: () {
                    context.read<LoginUserCubit>().signOut();
                  },
                  icon: const Icon(Icons.logout_rounded));
            },
          )
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
