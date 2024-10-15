import "package:dio/dio.dart";
import "package:frontend/models/models.dart";
import "package:frontend/models/requests/requests.dart";
import 'package:frontend/repositories/auth/base_auth_repository.dart';
import "package:frontend/repositories/core/endpoints.dart";
import "package:frontend/utils/dio_client/dio_client.dart";

class AuthRepository extends BaseAuthRepository {
  AuthRepository({
    Dio? dioClient,
  }) : _dioClient = dioClient ?? DioClient().instance;

  final Dio _dioClient;

  @override
  Future<AppResponse<AuthUser?>> login(LoginRequest request) async {
    final response = await _dioClient.post(
      Endpoints.login,
      data: request.toJson(),
    );

    print('Raw login response: ${response.data}');

    return AppResponse<AuthUser?>.fromJson(
      response.data,
      (dynamic json) => json != null ? AuthUser.fromJson(json) : null,
    );
  }

  @override
  Future<AppResponse> logout() async {
    final response = await _dioClient.get(Endpoints.logout);

    return AppResponse.fromJson(response.data, (dynamic json) => null);
  }

  @override
  Future<AppResponse<AuthUser?>> register(RegisterRequest request) async {
    final response = await _dioClient.post(
      Endpoints.register,
      data: request.toJson(),
    );

    return AppResponse<AuthUser?>.fromJson(
      response.data,
      (dynamic json) => json != null ? AuthUser.fromJson(json) : null,
    );
  }
}
