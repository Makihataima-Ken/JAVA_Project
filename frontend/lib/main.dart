import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:frontend/blocs/blocs.dart';
import 'package:frontend/cubits/cubits.dart';
import 'package:frontend/repositories/repositories.dart';
import 'package:frontend/screens/screens.dart';
import 'package:hydrated_bloc/hydrated_bloc.dart';
import 'package:path_provider/path_provider.dart';

void main() async {
  WidgetsFlutterBinding.ensureInitialized();
  HydratedBloc.storage = await HydratedStorage.build(
    storageDirectory: kIsWeb
        ? HydratedStorage.webStorageDirectory
        : await getTemporaryDirectory(),
  );

  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MultiRepositoryProvider(
      providers: [
        RepositoryProvider<AuthRepository>(
          create: (_) => AuthRepository(),
        ),
      ],
      child: MultiBlocProvider(
        providers: [
          BlocProvider(create: (_) => AuthBloc()),
          BlocProvider(
            create: (context) => LoginUserCubit(
              authRepository: context.read<AuthRepository>(),
              authBloc: context.read<AuthBloc>(),
            ),
          ),
        ],
        child: MaterialApp(
          debugShowCheckedModeBanner: false,
          title: 'Java Project',
          theme: ThemeData(
            primarySwatch: Colors.deepPurple,
          ),
          initialRoute: LoginScreen.routeName,
          routes: {
            LoginScreen.routeName: (_) => const LoginScreen(),
            TemporaryScreen.routeName: (_) => const TemporaryScreen(),
          },
        ),
      ),
    );
  }
}
