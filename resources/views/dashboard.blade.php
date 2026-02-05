<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Personal Finance Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-primary">

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
        <div class="container">
            <h2 class="navbar-brand text-white mb-0">FinSage - Personal Finance</h2>
            
            <div class="navbar-nav ms-auto">
                <span class="navbar-text text-white me-3">Welcome, {{ Auth::user()->name }}!</span>
                <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-sm me-2">
                    <i class="fas fa-home"></i> Dashboard
                </a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        
        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Financial Summary Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card bg-success text-white shadow">
                    <div class="card-body text-center">
                        <i class="fas fa-arrow-up fa-2x mb-2"></i>
                        <h4>Total Income</h4>
                        <h2>${{ number_format($totalIncome, 2) }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-danger text-white shadow">
                    <div class="card-body text-center">
                        <i class="fas fa-arrow-down fa-2x mb-2"></i>
                        <h4>Total Expenses</h4>
                        <h2>${{ number_format($totalExpense, 2) }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card {{ $balance >= 0 ? 'bg-info' : 'bg-warning' }} text-white shadow">
                    <div class="card-body text-center">
                        <i class="fas fa-wallet fa-2x mb-2"></i>
                        <h4>Balance</h4>
                        <h2>${{ number_format($balance, 2) }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Add Transaction Form -->
            <div class="col-lg-4">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-plus"></i> Add New Transaction</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('transactions.store') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                                       value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="2">{{ old('description') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Amount</label>
                                <input type="number" name="amount" step="0.01" min="0.01" 
                                       class="form-control @error('amount') is-invalid @enderror" 
                                       value="{{ old('amount') }}" required>
                                @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Type</label>
                                <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                                    <option value="">Select Type</option>
                                    <option value="income" {{ old('type') == 'income' ? 'selected' : '' }}>Income</option>
                                    <option value="expense" {{ old('type') == 'expense' ? 'selected' : '' }}>Expense</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select name="category" class="form-select @error('category') is-invalid @enderror" required>
                                    <option value="">Select Category</option>
                                    <option value="Food" {{ old('category') == 'Food' ? 'selected' : '' }}>Food</option>
                                    <option value="Transportation" {{ old('category') == 'Transportation' ? 'selected' : '' }}>Transportation</option>
                                    <option value="Entertainment" {{ old('category') == 'Entertainment' ? 'selected' : '' }}>Entertainment</option>
                                    <option value="Shopping" {{ old('category') == 'Shopping' ? 'selected' : '' }}>Shopping</option>
                                    <option value="Bills" {{ old('category') == 'Bills' ? 'selected' : '' }}>Bills</option>
                                    <option value="Healthcare" {{ old('category') == 'Healthcare' ? 'selected' : '' }}>Healthcare</option>
                                    <option value="Salary" {{ old('category') == 'Salary' ? 'selected' : '' }}>Salary</option>
                                    <option value="Business" {{ old('category') == 'Business' ? 'selected' : '' }}>Business</option>
                                    <option value="Investment" {{ old('category') == 'Investment' ? 'selected' : '' }}>Investment</option>
                                    <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" name="transaction_date" 
                                       class="form-control @error('transaction_date') is-invalid @enderror" 
                                       value="{{ old('transaction_date', date('Y-m-d')) }}" required>
                                @error('transaction_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-plus"></i> Add Transaction
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Transactions List -->
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-list"></i> Recent Transactions</h5>
                    </div>
                    <div class="card-body">
                        @if($transactions->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Type</th>
                                            <th>Amount</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($transactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction->transaction_date->format('M d, Y') }}</td>
                                                <td>
                                                    <strong>{{ $transaction->title }}</strong>
                                                    @if($transaction->description)
                                                        <br><small class="text-muted">{{ $transaction->description }}</small>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="badge bg-secondary">{{ $transaction->category }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge {{ $transaction->type == 'income' ? 'bg-success' : 'bg-danger' }}">
                                                        <i class="fas fa-arrow-{{ $transaction->type == 'income' ? 'up' : 'down' }}"></i>
                                                        {{ ucfirst($transaction->type) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <strong class="{{ $transaction->type == 'income' ? 'text-success' : 'text-danger' }}">
                                                        {{ $transaction->type == 'income' ? '+' : '-' }}${{ number_format($transaction->amount, 2) }}
                                                    </strong>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary" 
                                                            onclick="editTransaction({{ $transaction->id }}, '{{ $transaction->title }}', '{{ $transaction->description }}', {{ $transaction->amount }}, '{{ $transaction->type }}', '{{ $transaction->category }}', '{{ $transaction->transaction_date->format('Y-m-d') }}')">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <form method="POST" action="{{ route('transactions.destroy', $transaction) }}" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                                onclick="return confirm('Are you sure you want to delete this transaction?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-receipt fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">No transactions yet</h5>
                                <p class="text-muted">Start by adding your first transaction!</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Transaction Modal -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Edit Transaction</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" id="editTitle" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" id="editDescription" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Amount</label>
                            <input type="number" name="amount" id="editAmount" step="0.01" min="0.01" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Type</label>
                            <select name="type" id="editType" class="form-select" required>
                                <option value="income">Income</option>
                                <option value="expense">Expense</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select name="category" id="editCategory" class="form-select" required>
                                <option value="Food">Food</option>
                                <option value="Transportation">Transportation</option>
                                <option value="Entertainment">Entertainment</option>
                                <option value="Shopping">Shopping</option>
                                <option value="Bills">Bills</option>
                                <option value="Healthcare">Healthcare</option>
                                <option value="Salary">Salary</option>
                                <option value="Business">Business</option>
                                <option value="Investment">Investment</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" name="transaction_date" id="editDate" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Transaction</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function editTransaction(id, title, description, amount, type, category, date) {
            document.getElementById('editForm').action = `/transactions/${id}`;
            document.getElementById('editTitle').value = title;
            document.getElementById('editDescription').value = description;
            document.getElementById('editAmount').value = amount;
            document.getElementById('editType').value = type;
            document.getElementById('editCategory').value = category;
            document.getElementById('editDate').value = date;
            
            new bootstrap.Modal(document.getElementById('editModal')).show();
        }
    </script>

</body>
</html>
