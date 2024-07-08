<x-layouts.admin-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Notifications</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Notification Title</th>
                            <th>Notification Content</th>
                            <th>Notification Ingredients</th>
                            <th>Notification Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($notifications as $notification)
                            <tr>
                                <td>{{ $notification->title }}</td>
                                <td>{{ $notification->content }}</td>
                                <td>{{ $notification->ingredient->name }}</td>
                                <td>{{ $notification->getCreatedAtAttribute($notification->created_at) }}</td>
                                <td>
                                    <a href="/inventory" class="btn btn-primary">Go</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-layouts.admin-layout>