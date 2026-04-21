<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post - Blog Platform</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 40px;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }

        .header h1 {
            font-size: 28px;
            color: #333;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header h1 i {
            color: #667eea;
        }

        .back-btn {
            background: #6c757d;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .back-btn:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        label i {
            color: #667eea;
            margin-right: 8px;
        }

        input, textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
            outline: none;
            font-family: inherit;
        }

        input:focus, textarea:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        textarea {
            min-height: 200px;
            resize: vertical;
        }

        .button-group {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .update-btn {
            flex: 1;
            padding: 12px;
            background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .update-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(39, 174, 96, 0.4);
        }

        .cancel-btn {
            flex: 1;
            padding: 12px;
            background: #e74c3c;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-align: center;
        }

        .cancel-btn:hover {
            background: #c0392b;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(231, 76, 60, 0.4);
        }

        /* Error Messages */
        .error-messages {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #f5c6cb;
        }

        .error-messages ul {
            margin: 0;
            padding-left: 20px;
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #28a745;
        }

        @media (max-width: 768px) {
            .card {
                padding: 25px;
            }
            
            .header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
            
            .button-group {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <h1>
                    <i class="fas fa-edit"></i> 
                    Edit Post
                </h1>
                <a href="/" class="back-btn">
                    <i class="fas fa-arrow-left"></i> Back to Dashboard
                </a>
            </div>

            @if($errors->any())
                <div class="error-messages">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            <form action="/edit-post/{{ $post->id }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="title">
                        <i class="fas fa-heading"></i> Title
                    </label>
                    <input type="text" 
                           id="title" 
                           name="title" 
                           value="{{ old('title', $post->title) }}" 
                           placeholder="Enter post title"
                           required>
                </div>

                <div class="form-group">
                    <label for="body">
                        <i class="fas fa-paragraph"></i> Content
                    </label>
                    <textarea id="body" 
                              name="body" 
                              placeholder="Write your post content here..."
                              required>{{ old('body', $post->body) }}</textarea>
                </div>

                <div class="button-group">
                    <button type="submit" class="update-btn">
                        <i class="fas fa-save"></i> Update Post
                    </button>
                    <a href="/" class="cancel-btn">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>