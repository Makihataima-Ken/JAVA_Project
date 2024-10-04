import 'package:dio/dio.dart';

class DioClient {
  static DioClient? _singleton;

  static late Dio _dio;

  DioClient._() {
    _dio = createDioClient();
  }

  factory DioClient() {
    return _singleton ??= DioClient._();
  }

  Dio get instance => _dio;

  Dio createDioClient() {
    final dio = Dio(BaseOptions(
      baseUrl: "http://127.0.0.1:8000",
      receiveTimeout: const Duration(milliseconds: 15000),
      connectTimeout: const Duration(milliseconds: 15000),
      sendTimeout: const Duration(milliseconds: 15000),
      headers: {
        Headers.acceptHeader: 'application/json',
        Headers.contentTypeHeader: 'application/json'
      },
    ));

    return dio;
  }
}
