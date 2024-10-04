import "package:frontend/models/models.dart";
import "package:frontend/models/requests/requests.dart";
import 'package:frontend/repositories/auth/base_auth_repository.dart';

class AuthRepository extends BaseAuthRepository {
  @override
  Future<AppResponse<AuthUser?>> login(LoginRequest request) {
    // TODO: implement login
    throw UnimplementedError();
  }

  @override
  Future<AppResponse> logout() {
    // TODO: implement logout
    throw UnimplementedError();
  }

  @override
  Future<AppResponse<AuthUser?>> register(RegisterRequest request) {
    // TODO: implement register
    throw UnimplementedError();
  }
}
