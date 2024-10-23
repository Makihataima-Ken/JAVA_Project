import 'package:flutter_secure_storage/flutter_secure_storage.dart';

class TokenStorage {
  final FlutterSecureStorage _storage = const FlutterSecureStorage();

  Future<void> saveToken(String token) async {
    await _storage.write(key: 'jwt_token', value: token);
  }

  Future<String?> getToken() async {
    final token = await _storage.read(key: 'jwt_token');
    return token;
  }

  Future<void> deleteToken() async {
    await _storage.delete(key: 'jwt_token');
  }
}
