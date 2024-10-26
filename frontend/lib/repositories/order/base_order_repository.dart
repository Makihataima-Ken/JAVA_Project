import 'package:frontend/models/models.dart';
import 'package:frontend/models/requests/requests.dart';

abstract class BaseOrderRepository {
  Future<AppResponse<NewOrder?>> uploadOrder(UploadOrderRequest request);
}
