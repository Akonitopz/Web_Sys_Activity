import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';

const String apiBaseUrl = 'http://10.0.2.2:8000/api';
// For Chrome/Desktop testing, use:
// const String apiBaseUrl = 'http://127.0.0.1:8000/api';

void main() {
  runApp(const PayrollApp());
}

class PayrollApp extends StatelessWidget {
  const PayrollApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Payroll Mobile App',
      debugShowCheckedModeBanner: false,
      theme: ThemeData(
        useMaterial3: true,
        scaffoldBackgroundColor: const Color(0xFFF4F7FB),
        colorScheme: ColorScheme.fromSeed(
          seedColor: const Color(0xFF0F172A),
          primary: const Color(0xFF0F172A),
          secondary: const Color(0xFF38BDF8),
          surface: Colors.white,
        ),
        appBarTheme: const AppBarTheme(
          backgroundColor: Colors.white,
          foregroundColor: Color(0xFF0F172A),
          centerTitle: false,
          elevation: 0,
          surfaceTintColor: Colors.white,
        ),
        cardTheme: CardThemeData(
          color: Colors.white,
          elevation: 1.5,
          shadowColor: Colors.black.withOpacity(0.08),
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(18),
          ),
        ),
        inputDecorationTheme: InputDecorationTheme(
          filled: true,
          fillColor: Colors.white,
          border: OutlineInputBorder(
            borderRadius: BorderRadius.circular(14),
            borderSide: const BorderSide(color: Color(0xFFE5E7EB)),
          ),
          enabledBorder: OutlineInputBorder(
            borderRadius: BorderRadius.circular(14),
            borderSide: const BorderSide(color: Color(0xFFE5E7EB)),
          ),
          focusedBorder: OutlineInputBorder(
            borderRadius: BorderRadius.circular(14),
            borderSide: const BorderSide(color: Color(0xFF38BDF8), width: 1.5),
          ),
        ),
        elevatedButtonTheme: ElevatedButtonThemeData(
          style: ElevatedButton.styleFrom(
            backgroundColor: const Color(0xFF0F172A),
            foregroundColor: Colors.white,
            padding: const EdgeInsets.symmetric(horizontal: 18, vertical: 15),
            shape: RoundedRectangleBorder(
              borderRadius: BorderRadius.circular(14),
            ),
          ),
        ),
      ),
      home: const SplashScreen(),
    );
  }
}

class ApiClient {
  static Future<String?> token() async {
    final prefs = await SharedPreferences.getInstance();
    return prefs.getString('auth_token');
  }

  static Future<http.Response> get(String path) async {
    final authToken = await token();

    return http.get(
      Uri.parse('$apiBaseUrl$path'),
      headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer $authToken',
      },
    );
  }

  static Future<http.Response> post(String path, Map<String, dynamic> body) async {
    final authToken = await token();

    return http.post(
      Uri.parse('$apiBaseUrl$path'),
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        if (authToken != null) 'Authorization': 'Bearer $authToken',
      },
      body: jsonEncode(body),
    );
  }
}

class AppFormat {
  static String peso(dynamic value) {
    final number = double.tryParse(value.toString()) ?? 0;
    return '₱${number.toStringAsFixed(2)}';
  }

  static String date(dynamic value) {
    if (value == null) return 'No date';
    return value.toString().replaceFirst('T', ' ').split('.').first;
  }
}

class AppLoader extends StatelessWidget {
  const AppLoader({super.key, this.message = 'Loading...'});

  final String message;

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Center(
        child: Column(
          mainAxisSize: MainAxisSize.min,
          children: [
            const CircularProgressIndicator(),
            const SizedBox(height: 14),
            Text(message),
          ],
        ),
      ),
    );
  }
}

class EmptyState extends StatelessWidget {
  const EmptyState({
    super.key,
    required this.icon,
    required this.title,
    required this.subtitle,
  });

  final IconData icon;
  final String title;
  final String subtitle;

  @override
  Widget build(BuildContext context) {
    return Center(
      child: Padding(
        padding: const EdgeInsets.all(28),
        child: Column(
          mainAxisSize: MainAxisSize.min,
          children: [
            Icon(icon, size: 54, color: Colors.grey.shade500),
            const SizedBox(height: 12),
            Text(
              title,
              style: const TextStyle(fontSize: 18, fontWeight: FontWeight.w800),
            ),
            const SizedBox(height: 6),
            Text(
              subtitle,
              textAlign: TextAlign.center,
              style: TextStyle(color: Colors.grey.shade600),
            ),
          ],
        ),
      ),
    );
  }
}

class SectionTitle extends StatelessWidget {
  const SectionTitle(this.title, {super.key});

  final String title;

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 12),
      child: Text(
        title,
        style: const TextStyle(
          fontSize: 18,
          fontWeight: FontWeight.w900,
          color: Color(0xFF111827),
        ),
      ),
    );
  }
}

class StatCard extends StatelessWidget {
  const StatCard({
    super.key,
    required this.title,
    required this.value,
    required this.icon,
  });

  final String title;
  final String value;
  final IconData icon;

  @override
  Widget build(BuildContext context) {
    return Card(
      child: Padding(
        padding: const EdgeInsets.all(16),
        child: Row(
          children: [
            Container(
              padding: const EdgeInsets.all(12),
              decoration: BoxDecoration(
                color: const Color(0xFFE0F2FE),
                borderRadius: BorderRadius.circular(14),
              ),
              child: Icon(icon, color: const Color(0xFF0284C7)),
            ),
            const SizedBox(width: 12),
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    title,
                    style: TextStyle(color: Colors.grey.shade600, fontSize: 13),
                  ),
                  const SizedBox(height: 4),
                  Text(
                    value,
                    maxLines: 1,
                    overflow: TextOverflow.ellipsis,
                    style: const TextStyle(
                      fontSize: 21,
                      fontWeight: FontWeight.w900,
                    ),
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}

class MenuTile extends StatelessWidget {
  const MenuTile({
    super.key,
    required this.title,
    required this.subtitle,
    required this.icon,
    required this.onTap,
  });

  final String title;
  final String subtitle;
  final IconData icon;
  final VoidCallback onTap;

  @override
  Widget build(BuildContext context) {
    return Card(
      child: InkWell(
        borderRadius: BorderRadius.circular(18),
        onTap: onTap,
        child: Padding(
          padding: const EdgeInsets.all(16),
          child: Row(
            children: [
              Container(
                padding: const EdgeInsets.all(12),
                decoration: BoxDecoration(
                  color: const Color(0xFFF1F5F9),
                  borderRadius: BorderRadius.circular(14),
                ),
                child: Icon(icon, color: const Color(0xFF0F172A)),
              ),
              const SizedBox(width: 14),
              Expanded(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      title,
                      style: const TextStyle(
                        fontWeight: FontWeight.w900,
                        fontSize: 16,
                      ),
                    ),
                    const SizedBox(height: 4),
                    Text(
                      subtitle,
                      style: TextStyle(color: Colors.grey.shade600),
                    ),
                  ],
                ),
              ),
              const Icon(Icons.chevron_right),
            ],
          ),
        ),
      ),
    );
  }
}

class SplashScreen extends StatefulWidget {
  const SplashScreen({super.key});

  @override
  State<SplashScreen> createState() => _SplashScreenState();
}

class _SplashScreenState extends State<SplashScreen> {
  @override
  void initState() {
    super.initState();
    checkLogin();
  }

  Future<void> checkLogin() async {
    final prefs = await SharedPreferences.getInstance();
    final token = prefs.getString('auth_token');

    await Future.delayed(const Duration(seconds: 1));

    if (!mounted) return;

    Navigator.pushReplacement(
      context,
      MaterialPageRoute(
        builder: (_) => token != null ? const DashboardScreen() : const LoginScreen(),
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return const Scaffold(
      body: Center(
        child: Text(
          'Payroll',
          style: TextStyle(fontSize: 34, fontWeight: FontWeight.w900),
        ),
      ),
    );
  }
}

class LoginScreen extends StatefulWidget {
  const LoginScreen({super.key});

  @override
  State<LoginScreen> createState() => _LoginScreenState();
}

class _LoginScreenState extends State<LoginScreen> {
  final emailController = TextEditingController();
  final passwordController = TextEditingController();

  bool isLoading = false;
  bool hidePassword = true;

  Future<void> login() async {
    if (emailController.text.trim().isEmpty || passwordController.text.isEmpty) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text('Please enter email and password.')),
      );
      return;
    }

    setState(() => isLoading = true);

    try {
      final response = await http.post(
        Uri.parse('$apiBaseUrl/login'),
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
        },
        body: jsonEncode({
          'email': emailController.text.trim(),
          'password': passwordController.text,
        }),
      );

      final data = jsonDecode(response.body);

      if (response.statusCode == 200) {
        final prefs = await SharedPreferences.getInstance();
        await prefs.setString('auth_token', data['token']);

        if (!mounted) return;

        Navigator.pushReplacement(
          context,
          MaterialPageRoute(builder: (_) => const DashboardScreen()),
        );
      } else {
        if (!mounted) return;
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text(data['message'] ?? 'Login failed')),
        );
      }
    } catch (e) {
      if (!mounted) return;
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text('Connection error: $e')),
      );
    }

    if (mounted) setState(() => isLoading = false);
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SafeArea(
        child: ListView(
          padding: const EdgeInsets.all(24),
          children: [
            const SizedBox(height: 48),
            Container(
              height: 76,
              width: 76,
              alignment: Alignment.center,
              decoration: BoxDecoration(
                color: const Color(0xFF0F172A),
                borderRadius: BorderRadius.circular(24),
              ),
              child: const Icon(Icons.payments, color: Colors.white, size: 38),
            ),
            const SizedBox(height: 24),
            const Text(
              'Welcome back',
              style: TextStyle(fontSize: 32, fontWeight: FontWeight.w900),
            ),
            const SizedBox(height: 8),
            Text(
              'Sign in to manage payroll, employees, attendance, and audit logs.',
              style: TextStyle(color: Colors.grey.shade600, fontSize: 15),
            ),
            const SizedBox(height: 32),
            TextField(
              controller: emailController,
              keyboardType: TextInputType.emailAddress,
              decoration: const InputDecoration(
                labelText: 'Email',
                prefixIcon: Icon(Icons.email_outlined),
              ),
            ),
            const SizedBox(height: 16),
            TextField(
              controller: passwordController,
              obscureText: hidePassword,
              decoration: InputDecoration(
                labelText: 'Password',
                prefixIcon: const Icon(Icons.lock_outline),
                suffixIcon: IconButton(
                  onPressed: () => setState(() => hidePassword = !hidePassword),
                  icon: Icon(hidePassword ? Icons.visibility : Icons.visibility_off),
                ),
              ),
            ),
            const SizedBox(height: 24),
            SizedBox(
              width: double.infinity,
              child: ElevatedButton(
                onPressed: isLoading ? null : login,
                child: Text(isLoading ? 'Logging in...' : 'Login'),
              ),
            ),
          ],
        ),
      ),
    );
  }
}

class DashboardScreen extends StatefulWidget {
  const DashboardScreen({super.key});

  @override
  State<DashboardScreen> createState() => _DashboardScreenState();
}

class _DashboardScreenState extends State<DashboardScreen> {
  bool isLoading = true;
  Map<String, dynamic>? dashboardData;

  @override
  void initState() {
    super.initState();
    fetchDashboard();
  }

  Future<void> fetchDashboard() async {
    try {
      final response = await ApiClient.get('/dashboard');

      setState(() {
        dashboardData = jsonDecode(response.body);
        isLoading = false;
      });
    } catch (_) {
      setState(() => isLoading = false);
    }
  }

  Future<void> logout() async {
    final prefs = await SharedPreferences.getInstance();
    await prefs.remove('auth_token');

    if (!mounted) return;

    Navigator.pushReplacement(
      context,
      MaterialPageRoute(builder: (_) => const LoginScreen()),
    );
  }

  @override
  Widget build(BuildContext context) {
    if (isLoading) return const AppLoader(message: 'Loading dashboard...');

    final latestPayroll = dashboardData?['latest_payroll'];

    return Scaffold(
      appBar: AppBar(
        title: const Text(
          'Payroll Dashboard',
          style: TextStyle(fontWeight: FontWeight.w900),
        ),
        actions: [
          IconButton(
            onPressed: fetchDashboard,
            icon: const Icon(Icons.refresh),
          ),
          IconButton(
            onPressed: logout,
            icon: const Icon(Icons.logout),
          ),
        ],
      ),
      body: RefreshIndicator(
        onRefresh: fetchDashboard,
        child: ListView(
          padding: const EdgeInsets.all(16),
          children: [
            Container(
              padding: const EdgeInsets.all(20),
              decoration: BoxDecoration(
                color: const Color(0xFF0F172A),
                borderRadius: BorderRadius.circular(24),
              ),
              child: const Row(
                children: [
                  CircleAvatar(
                    radius: 26,
                    backgroundColor: Color(0xFF38BDF8),
                    child: Icon(Icons.payments, color: Colors.white),
                  ),
                  SizedBox(width: 14),
                  Expanded(
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text('Hello, Admin', style: TextStyle(color: Colors.white70)),
                        SizedBox(height: 4),
                        Text(
                          'Manage payroll operations',
                          style: TextStyle(
                            color: Colors.white,
                            fontSize: 19,
                            fontWeight: FontWeight.w900,
                          ),
                        ),
                      ],
                    ),
                  ),
                ],
              ),
            ),
            const SizedBox(height: 18),
            GridView.count(
              shrinkWrap: true,
              physics: const NeverScrollableScrollPhysics(),
              crossAxisCount: MediaQuery.of(context).size.width > 520 ? 4 : 2,
              mainAxisSpacing: 10,
              crossAxisSpacing: 10,
              childAspectRatio: 1.55,
              children: [
                StatCard(
                  title: 'Employees',
                  value: '${dashboardData?['total_employees'] ?? 0}',
                  icon: Icons.groups,
                ),
                StatCard(
                  title: 'Payrolls',
                  value: '${dashboardData?['total_payrolls'] ?? 0}',
                  icon: Icons.receipt_long,
                ),
                StatCard(
                  title: 'Amount Paid',
                  value: AppFormat.peso(dashboardData?['total_amount_paid'] ?? 0),
                  icon: Icons.account_balance_wallet,
                ),
                StatCard(
                  title: 'Latest',
                  value: latestPayroll == null
                      ? 'None'
                      : '${latestPayroll['month']} ${latestPayroll['year']}',
                  icon: Icons.calendar_month,
                ),
              ],
            ),
            const SizedBox(height: 24),
            const SectionTitle('Modules'),
            MenuTile(
              title: 'Employees',
              subtitle: 'View employee records',
              icon: Icons.groups,
              onTap: () => Navigator.push(
                context,
                MaterialPageRoute(builder: (_) => const EmployeeListScreen()),
              ),
            ),
            MenuTile(
              title: 'Payrolls',
              subtitle: 'View payroll records and payslips',
              icon: Icons.payments,
              onTap: () => Navigator.push(
                context,
                MaterialPageRoute(builder: (_) => const PayrollListScreen()),
              ),
            ),
            MenuTile(
              title: 'Attendance',
              subtitle: 'Review and record attendance',
              icon: Icons.schedule,
              onTap: () => Navigator.push(
                context,
                MaterialPageRoute(builder: (_) => const AttendanceListScreen()),
              ),
            ),
            MenuTile(
              title: 'Audit Logs',
              subtitle: 'Track user actions and system changes',
              icon: Icons.shield_outlined,
              onTap: () => Navigator.push(
                context,
                MaterialPageRoute(builder: (_) => const AuditLogListScreen()),
              ),
            ),
          ],
        ),
      ),
    );
  }
}

class EmployeeListScreen extends StatefulWidget {
  const EmployeeListScreen({super.key});

  @override
  State<EmployeeListScreen> createState() => _EmployeeListScreenState();
}

class _EmployeeListScreenState extends State<EmployeeListScreen> {
  bool isLoading = true;
  List employees = [];
  String search = '';

  @override
  void initState() {
    super.initState();
    fetchEmployees();
  }

  Future<void> fetchEmployees() async {
    final response = await ApiClient.get('/employees');

    setState(() {
      employees = jsonDecode(response.body);
      isLoading = false;
    });
  }

  @override
  Widget build(BuildContext context) {
    final filtered = employees.where((employee) {
      final name = '${employee['first_name']} ${employee['last_name']}'.toLowerCase();
      final department = '${employee['department']}'.toLowerCase();
      final keyword = search.toLowerCase();
      return name.contains(keyword) || department.contains(keyword);
    }).toList();

    return Scaffold(
      appBar: AppBar(title: const Text('Employees')),
      body: isLoading
          ? const Center(child: CircularProgressIndicator())
          : RefreshIndicator(
              onRefresh: fetchEmployees,
              child: ListView(
                padding: const EdgeInsets.all(16),
                children: [
                  TextField(
                    decoration: const InputDecoration(
                      hintText: 'Search employees...',
                      prefixIcon: Icon(Icons.search),
                    ),
                    onChanged: (value) => setState(() => search = value),
                  ),
                  const SizedBox(height: 14),
                  if (filtered.isEmpty)
                    const SizedBox(
                      height: 420,
                      child: EmptyState(
                        icon: Icons.groups,
                        title: 'No employees found',
                        subtitle: 'Try another name or department.',
                      ),
                    )
                  else
                    ...filtered.map((employee) {
                      return Card(
                        child: ListTile(
                          leading: CircleAvatar(
                            backgroundColor: const Color(0xFFE0F2FE),
                            child: Text(
                              '${employee['first_name']}'[0].toUpperCase(),
                              style: const TextStyle(color: Color(0xFF0284C7)),
                            ),
                          ),
                          title: Text(
                            '${employee['first_name']} ${employee['last_name']}',
                            style: const TextStyle(fontWeight: FontWeight.w800),
                          ),
                          subtitle: Text(
                            '${employee['employee_id']} • ${employee['department']}',
                          ),
                          trailing: Text(
                            AppFormat.peso(employee['salary']),
                            style: const TextStyle(fontWeight: FontWeight.w900),
                          ),
                        ),
                      );
                    }),
                ],
              ),
            ),
    );
  }
}

class PayrollListScreen extends StatefulWidget {
  const PayrollListScreen({super.key});

  @override
  State<PayrollListScreen> createState() => _PayrollListScreenState();
}

class _PayrollListScreenState extends State<PayrollListScreen> {
  bool isLoading = true;
  List payrolls = [];

  @override
  void initState() {
    super.initState();
    fetchPayrolls();
  }

  Future<void> fetchPayrolls() async {
    final response = await ApiClient.get('/payrolls');

    setState(() {
      payrolls = jsonDecode(response.body);
      isLoading = false;
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Payrolls'),
      ),
      body: isLoading
          ? const Center(child: CircularProgressIndicator())
          : payrolls.isEmpty
              ? const EmptyState(
                  icon: Icons.payments,
                  title: 'No payrolls found',
                  subtitle: 'Payroll records will appear here.',
                )
              : RefreshIndicator(
                  onRefresh: fetchPayrolls,
                  child: ListView.builder(
                    padding: const EdgeInsets.all(16),
                    itemCount: payrolls.length,
                    itemBuilder: (context, index) {
                      final payroll = payrolls[index];

                      return Card(
                        child: InkWell(
                          borderRadius: BorderRadius.circular(18),
                          onTap: () {
                            Navigator.push(
                              context,
                              MaterialPageRoute(
                                builder: (_) => PayrollDetailsScreen(
                                  payrollId: payroll['id'],
                                ),
                              ),
                            );
                          },
                          child: Padding(
                            padding: const EdgeInsets.all(16),
                            child: Column(
                              crossAxisAlignment: CrossAxisAlignment.start,
                              children: [
                                Row(
                                  children: [
                                    const Icon(Icons.receipt_long),
                                    const SizedBox(width: 8),
                                    Expanded(
                                      child: Text(
                                        '${payroll['month']} ${payroll['year']}',
                                        style: const TextStyle(
                                          fontSize: 18,
                                          fontWeight: FontWeight.w900,
                                        ),
                                      ),
                                    ),
                                    const Icon(Icons.chevron_right),
                                  ],
                                ),
                                const Divider(height: 24),
                                Text('Basic Salary: ${AppFormat.peso(payroll['basic_salary'])}'),
                                Text('Allowance: ${AppFormat.peso(payroll['allowance'])}'),
                                Text('Deduction: ${AppFormat.peso(payroll['deduction'])}'),
                                const SizedBox(height: 8),
                                Text(
                                  'Net Salary: ${AppFormat.peso(payroll['net_salary'])}',
                                  style: const TextStyle(fontWeight: FontWeight.w900),
                                ),
                              ],
                            ),
                          ),
                        ),
                      );
                    },
                  ),
                ),
    );
  }
}

class PayrollDetailsScreen extends StatefulWidget {
  final int payrollId;

  const PayrollDetailsScreen({
    super.key,
    required this.payrollId,
  });

  @override
  State<PayrollDetailsScreen> createState() => _PayrollDetailsScreenState();
}

class _PayrollDetailsScreenState extends State<PayrollDetailsScreen> {
  bool isLoading = true;
  Map<String, dynamic>? payroll;

  @override
  void initState() {
    super.initState();
    fetchPayroll();
  }

  Future<void> fetchPayroll() async {
    final response = await ApiClient.get('/payrolls/${widget.payrollId}');

    setState(() {
      payroll = jsonDecode(response.body);
      isLoading = false;
    });
  }

  @override
  Widget build(BuildContext context) {
    if (isLoading) return const AppLoader(message: 'Loading payslip...');

    final employee = payroll?['employee'];

    return Scaffold(
      appBar: AppBar(
        title: const Text('Payslip Details'),
      ),
      body: ListView(
        padding: const EdgeInsets.all(16),
        children: [
          Card(
            child: Padding(
              padding: const EdgeInsets.all(20),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    '${employee?['first_name'] ?? ''} ${employee?['last_name'] ?? ''}',
                    style: const TextStyle(
                      fontSize: 24,
                      fontWeight: FontWeight.w900,
                    ),
                  ),
                  const SizedBox(height: 6),
                  Text(
                    'Period: ${payroll?['month']} ${payroll?['year']}',
                    style: TextStyle(color: Colors.grey.shade600),
                  ),
                  const Divider(height: 30),
                  _payRow('Basic Salary', AppFormat.peso(payroll?['basic_salary'])),
                  _payRow('Allowance', AppFormat.peso(payroll?['allowance'])),
                  _payRow('Deduction', AppFormat.peso(payroll?['deduction'])),
                  const Divider(height: 30),
                  _payRow(
                    'Net Salary',
                    AppFormat.peso(payroll?['net_salary']),
                    isTotal: true,
                  ),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }

  Widget _payRow(String label, String value, {bool isTotal = false}) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 7),
      child: Row(
        children: [
          Expanded(
            child: Text(
              label,
              style: TextStyle(
                color: isTotal ? const Color(0xFF111827) : Colors.grey.shade700,
                fontWeight: isTotal ? FontWeight.w900 : FontWeight.w500,
              ),
            ),
          ),
          Text(
            value,
            style: TextStyle(
              fontSize: isTotal ? 22 : 15,
              fontWeight: FontWeight.w900,
            ),
          ),
        ],
      ),
    );
  }
}

class AttendanceListScreen extends StatefulWidget {
  const AttendanceListScreen({super.key});

  @override
  State<AttendanceListScreen> createState() => _AttendanceListScreenState();
}

class _AttendanceListScreenState extends State<AttendanceListScreen> {
  bool isLoading = true;
  List attendances = [];

  @override
  void initState() {
    super.initState();
    fetchAttendances();
  }

  Future<void> fetchAttendances() async {
    final response = await ApiClient.get('/attendances');

    setState(() {
      attendances = jsonDecode(response.body);
      isLoading = false;
    });
  }

  Color statusColor(String status) {
    switch (status.toLowerCase()) {
      case 'present':
        return Colors.green;
      case 'absent':
        return Colors.red;
      case 'late':
        return Colors.orange;
      case 'leave':
        return Colors.blue;
      default:
        return Colors.grey;
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Attendance'),
        actions: [
          IconButton(
            icon: const Icon(Icons.add),
            onPressed: () {
              Navigator.push(
                context,
                MaterialPageRoute(builder: (_) => const RecordAttendanceScreen()),
              ).then((_) => fetchAttendances());
            },
          ),
        ],
      ),
      floatingActionButton: FloatingActionButton.extended(
        onPressed: () {
          Navigator.push(
            context,
            MaterialPageRoute(builder: (_) => const RecordAttendanceScreen()),
          ).then((_) => fetchAttendances());
        },
        icon: const Icon(Icons.add),
        label: const Text('Record'),
      ),
      body: isLoading
          ? const Center(child: CircularProgressIndicator())
          : attendances.isEmpty
              ? const EmptyState(
                  icon: Icons.schedule,
                  title: 'No attendance records',
                  subtitle: 'Tap Record to create the first attendance entry.',
                )
              : RefreshIndicator(
                  onRefresh: fetchAttendances,
                  child: ListView.builder(
                    padding: const EdgeInsets.all(16),
                    itemCount: attendances.length,
                    itemBuilder: (context, index) {
                      final attendance = attendances[index];
                      final employee = attendance['employee'];
                      final status = attendance['status'] ?? '';

                      return Card(
                        child: ListTile(
                          leading: CircleAvatar(
                            backgroundColor: statusColor(status).withOpacity(0.12),
                            child: Icon(Icons.schedule, color: statusColor(status)),
                          ),
                          title: Text(
                            '${employee?['first_name'] ?? ''} ${employee?['last_name'] ?? ''}',
                            style: const TextStyle(fontWeight: FontWeight.w800),
                          ),
                          subtitle: Text('${attendance['date']} • ${attendance['remarks'] ?? 'No remarks'}'),
                          trailing: Chip(
                            label: Text(status),
                            backgroundColor: statusColor(status).withOpacity(0.12),
                            labelStyle: TextStyle(
                              color: statusColor(status),
                              fontWeight: FontWeight.w800,
                            ),
                            side: BorderSide.none,
                          ),
                        ),
                      );
                    },
                  ),
                ),
    );
  }
}

class RecordAttendanceScreen extends StatefulWidget {
  const RecordAttendanceScreen({super.key});

  @override
  State<RecordAttendanceScreen> createState() => _RecordAttendanceScreenState();
}

class _RecordAttendanceScreenState extends State<RecordAttendanceScreen> {
  bool isLoading = true;
  bool isSubmitting = false;

  List employees = [];
  int? selectedEmployeeId;
  String selectedStatus = 'Present';

  final dateController = TextEditingController();
  final remarksController = TextEditingController();

  @override
  void initState() {
    super.initState();
    dateController.text = DateTime.now().toString().split(' ')[0];
    fetchEmployees();
  }

  Future<void> fetchEmployees() async {
    final response = await ApiClient.get('/attendance-employees');

    setState(() {
      employees = jsonDecode(response.body);
      isLoading = false;
    });
  }

  Future<void> submitAttendance() async {
    if (selectedEmployeeId == null) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text('Please select an employee.')),
      );
      return;
    }

    setState(() => isSubmitting = true);

    final response = await ApiClient.post('/attendances', {
      'employee_id': selectedEmployeeId,
      'date': dateController.text,
      'status': selectedStatus,
      'remarks': remarksController.text,
    });

    setState(() => isSubmitting = false);

    if (response.statusCode == 201) {
      if (!context.mounted) return;

      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text('Attendance recorded successfully.')),
      );

      Navigator.pop(context);
    } else {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text('Failed to record attendance.')),
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    if (isLoading) return const AppLoader(message: 'Loading employees...');

    return Scaffold(
      appBar: AppBar(
        title: const Text('Record Attendance'),
      ),
      body: ListView(
        padding: const EdgeInsets.all(16),
        children: [
          DropdownButtonFormField<int>(
            value: selectedEmployeeId,
            decoration: const InputDecoration(
              labelText: 'Employee',
              prefixIcon: Icon(Icons.person_outline),
            ),
            items: employees.map<DropdownMenuItem<int>>((employee) {
              return DropdownMenuItem<int>(
                value: employee['id'],
                child: Text('${employee['first_name']} ${employee['last_name']}'),
              );
            }).toList(),
            onChanged: (value) => setState(() => selectedEmployeeId = value),
          ),
          const SizedBox(height: 16),
          TextField(
            controller: dateController,
            decoration: const InputDecoration(
              labelText: 'Date',
              prefixIcon: Icon(Icons.calendar_today),
            ),
          ),
          const SizedBox(height: 16),
          DropdownButtonFormField<String>(
            value: selectedStatus,
            decoration: const InputDecoration(
              labelText: 'Status',
              prefixIcon: Icon(Icons.fact_check_outlined),
            ),
            items: const [
              DropdownMenuItem(value: 'Present', child: Text('Present')),
              DropdownMenuItem(value: 'Absent', child: Text('Absent')),
              DropdownMenuItem(value: 'Late', child: Text('Late')),
              DropdownMenuItem(value: 'Leave', child: Text('Leave')),
            ],
            onChanged: (value) => setState(() => selectedStatus = value!),
          ),
          const SizedBox(height: 16),
          TextField(
            controller: remarksController,
            maxLines: 3,
            decoration: const InputDecoration(
              labelText: 'Remarks',
              prefixIcon: Icon(Icons.notes),
            ),
          ),
          const SizedBox(height: 24),
          SizedBox(
            width: double.infinity,
            child: ElevatedButton(
              onPressed: isSubmitting ? null : submitAttendance,
              child: Text(isSubmitting ? 'Saving...' : 'Save Attendance'),
            ),
          ),
        ],
      ),
    );
  }
}

class AuditLogListScreen extends StatefulWidget {
  const AuditLogListScreen({super.key});

  @override
  State<AuditLogListScreen> createState() => _AuditLogListScreenState();
}

class _AuditLogListScreenState extends State<AuditLogListScreen> {
  List auditLogs = [];
  bool isLoading = true;
  String search = '';

  @override
  void initState() {
    super.initState();
    fetchAuditLogs();
  }

  Future<void> fetchAuditLogs() async {
    final response = await ApiClient.get('/audit-logs');

    if (response.statusCode == 200) {
      setState(() {
        auditLogs = jsonDecode(response.body);
        isLoading = false;
      });
    } else {
      setState(() => isLoading = false);
    }
  }

  @override
  Widget build(BuildContext context) {
    final filtered = auditLogs.where((log) {
      final keyword = search.toLowerCase();
      final text = '${log['action']} ${log['module']} ${log['description']} ${log['user']?['name']}'.toLowerCase();
      return text.contains(keyword);
    }).toList();

    return Scaffold(
      appBar: AppBar(
        title: const Text('Audit Logs'),
      ),
      body: isLoading
          ? const Center(child: CircularProgressIndicator())
          : RefreshIndicator(
              onRefresh: fetchAuditLogs,
              child: ListView(
                padding: const EdgeInsets.all(16),
                children: [
                  TextField(
                    decoration: const InputDecoration(
                      hintText: 'Search logs...',
                      prefixIcon: Icon(Icons.search),
                    ),
                    onChanged: (value) => setState(() => search = value),
                  ),
                  const SizedBox(height: 14),
                  if (filtered.isEmpty)
                    const SizedBox(
                      height: 420,
                      child: EmptyState(
                        icon: Icons.shield_outlined,
                        title: 'No audit logs found',
                        subtitle: 'System activity will appear here.',
                      ),
                    )
                  else
                    ...filtered.map((log) {
                      final user = log['user'];

                      return Card(
                        child: Padding(
                          padding: const EdgeInsets.all(16),
                          child: Row(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              const CircleAvatar(
                                backgroundColor: Color(0xFFE0F2FE),
                                child: Icon(Icons.shield_outlined, color: Color(0xFF0284C7)),
                              ),
                              const SizedBox(width: 12),
                              Expanded(
                                child: Column(
                                  crossAxisAlignment: CrossAxisAlignment.start,
                                  children: [
                                    Text(
                                      '${log['action'] ?? 'No action'} • ${log['module'] ?? 'No module'}',
                                      style: const TextStyle(
                                        fontWeight: FontWeight.w900,
                                        fontSize: 15,
                                      ),
                                    ),
                                    const SizedBox(height: 6),
                                    Text(log['description'] ?? 'No description'),
                                    const SizedBox(height: 8),
                                    Text(
                                      '${user?['name'] ?? 'Unknown'} • ${AppFormat.date(log['created_at'])}',
                                      style: TextStyle(
                                        color: Colors.grey.shade600,
                                        fontSize: 12,
                                      ),
                                    ),
                                  ],
                                ),
                              ),
                            ],
                          ),
                        ),
                      );
                    }),
                ],
              ),
            ),
    );
  }
}
