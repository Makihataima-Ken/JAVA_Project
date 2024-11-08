part of 'new_order_cubit.dart';

@freezed
class NewOrderState with _$NewOrderState {
  const factory NewOrderState.initial() = _Initial;
  const factory NewOrderState.loading() = _Loading;
  const factory NewOrderState.success(NewOrder newOrder) = _Success;
  const factory NewOrderState.failure(String error) = _Failure;
}
