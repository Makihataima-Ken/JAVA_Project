import 'package:frontend/models/models.dart';
import 'package:frontend/models/requests/requests.dart';
import "package:frontend/repositories/core/endpoints.dart";
import 'package:frontend/utils/utils.dart';
import 'base_order_repository.dart';
import "package:dio/dio.dart";

class OrderRepository extends BaseOrderRepository {
  OrderRepository({
    Dio? dioClient,
  }) : _dioClient = dioClient ?? DioClient().instance;

  final Dio _dioClient;

  @override
  Future<AppResponse<NewOrder?>> submitOrder(UploadOrderRequest request) async {
    final formData = FormData.fromMap(
      {
        'university': request.universityName,
        'major': request.majorName,
        'type': request.orderType,
        'description': request.orderDescription,
        'deadline': request.deadline,
        if (request.filePath != null)
          'file_path': await MultipartFile.fromFile(request.filePath!),
      },
    );

    final response = await _dioClient.get(
      Endpoints.order,
      data: formData,
    );

    return AppResponse<NewOrder?>.fromJson(
      response.data,
      (dynamic json) {
        if (json != null) {
          return NewOrder(
            orderCreatedAt: json['created_at'],
            order: json['order'],
          );
        }
        return null;
      },
    );
  }
}
