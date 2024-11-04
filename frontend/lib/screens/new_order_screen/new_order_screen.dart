import 'package:flutter/material.dart';
import 'package:intl/intl.dart';

class NewOrderScreen extends StatefulWidget {
  const NewOrderScreen({super.key});
  static const routeName = 'new order';

  @override
  NewOrderScreenState createState() => NewOrderScreenState();
}

class NewOrderScreenState extends State<NewOrderScreen> {
  final _formKey = GlobalKey<FormState>();

  String? selectedUniversity;
  String? selectedMajor;
  String? selectedOrderType;
  final TextEditingController descriptionController = TextEditingController();
  final TextEditingController deadlineController = TextEditingController();

  // Dropdown options
  final List<String> universityOptions = ['7mmodeh'];
  final List<String> majorOptions = ['7mmodeh'];
  final List<String> orderTypeOptions = ['7mmodeh'];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('New Order'),
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: SingleChildScrollView(
          child: Form(
            key: _formKey,
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                // University Dropdown
                DropdownButtonFormField<String>(
                  items: universityOptions.map((String option) {
                    return DropdownMenuItem<String>(
                      value: option,
                      child: Text(option),
                    );
                  }).toList(),
                  onChanged: (newValue) {
                    setState(() {
                      selectedUniversity = newValue;
                    });
                  },
                  decoration: const InputDecoration(
                    labelText: 'University',
                    border: OutlineInputBorder(),
                  ),
                  validator: (value) =>
                      value == null ? 'Please select a university' : null,
                ),
                const SizedBox(height: 16.0),

                // Major Dropdown
                DropdownButtonFormField<String>(
                  items: majorOptions.map((String option) {
                    return DropdownMenuItem<String>(
                      value: option,
                      child: Text(option),
                    );
                  }).toList(),
                  onChanged: (newValue) {
                    setState(() {
                      selectedMajor = newValue;
                    });
                  },
                  decoration: const InputDecoration(
                    labelText: 'Major',
                    border: OutlineInputBorder(),
                  ),
                  validator: (value) =>
                      value == null ? 'Please select a major' : null,
                ),
                const SizedBox(height: 16.0),

                // Order Type Dropdown
                DropdownButtonFormField<String>(
                  items: orderTypeOptions.map((String option) {
                    return DropdownMenuItem<String>(
                      value: option,
                      child: Text(option),
                    );
                  }).toList(),
                  onChanged: (newValue) {
                    setState(() {
                      selectedOrderType = newValue;
                    });
                  },
                  decoration: const InputDecoration(
                    labelText: 'Order Type',
                    border: OutlineInputBorder(),
                  ),
                  validator: (value) =>
                      value == null ? 'Please select an order type' : null,
                ),
                const SizedBox(height: 16.0),

                // Description Input
                TextFormField(
                  controller: descriptionController,
                  decoration: const InputDecoration(
                    labelText: 'Description',
                    border: OutlineInputBorder(),
                  ),
                  maxLines: 4,
                  validator: (value) => value == null || value.isEmpty
                      ? 'Please enter a description'
                      : null,
                ),
                const SizedBox(height: 16.0),

                // Deadline Date Picker
                TextFormField(
                  readOnly: true,
                  controller: deadlineController,
                  decoration: InputDecoration(
                    labelText: 'Deadline',
                    border: const OutlineInputBorder(),
                    suffixIcon: IconButton(
                      icon: const Icon(Icons.calendar_today),
                      onPressed: () async {
                        DateTime? pickedDate = await showDatePicker(
                          context: context,
                          initialDate: DateTime.now(),
                          firstDate: DateTime.now(),
                          lastDate: DateTime(2100),
                        );
                        if (pickedDate != null) {
                          setState(() {
                            deadlineController.text =
                                DateFormat('yyyy-MM-dd').format(pickedDate);
                          });
                        }
                      },
                    ),
                  ),
                  validator: (value) => value == null || value.isEmpty
                      ? 'Please select a deadline'
                      : null,
                ),
                const SizedBox(height: 16.0),

                // Submit Button
                ElevatedButton(
                  onPressed: () {
                    if (_formKey.currentState!.validate()) {
                      // Handle form submission here
                    }
                  },
                  child: const Text('Submit Order'),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }

  @override
  void dispose() {
    descriptionController.dispose();
    deadlineController.dispose();
    super.dispose();
  }
}
