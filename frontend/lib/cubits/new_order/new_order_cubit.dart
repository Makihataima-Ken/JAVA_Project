import 'package:bloc/bloc.dart';
import 'package:freezed_annotation/freezed_annotation.dart';
import 'package:frontend/models/models.dart';
import 'package:frontend/models/requests/requests.dart';
import 'package:frontend/repositories/repositories.dart';
import 'package:frontend/blocs/auth/auth_bloc.dart';

part 'new_order_state.dart';
part 'new_order_cubit.freezed.dart';

class NewOrderCubit extends Cubit<NewOrderState> {
  final OrderRepository _orderRepository;

  NewOrderCubit({
    required OrderRepository orderRepository,
    required AuthBloc authBloc,
  })  : _orderRepository = orderRepository,
        super(const NewOrderState.initial());

  Future<void> submitOrder({
    required String university,
    required String major,
    required String orderType,
    required String description,
    required String deadline,
    String? filePath,
  }) async {
    emit(const NewOrderState.loading());

    try {
      final request = UploadOrderRequest(
        universityName: university,
        majorName: major,
        orderType: orderType,
        orderDescription: description,
        deadline: deadline,
        filePath: filePath,
      );

      final response = await _orderRepository.submitOrder(request);

      if (response.success && response.data != null) {
        emit(NewOrderState.success(response.data!));
      } else {
        emit(NewOrderState.failure(response.message));
      }
    } catch (e) {
      emit(NewOrderState.failure('An error occurred: ${e.toString()}'));
    }
  }
}
