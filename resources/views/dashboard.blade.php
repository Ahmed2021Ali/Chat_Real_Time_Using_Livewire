<x-app-layout>
    <div class="py-12 overflow-y-scroll">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div style="background-color: red" class="p-6 bg-white border-b border-gray-200">
                    <div id="wrapper">
                        <a href="http://127.0.0.1:8000/dashboard/chat" class="my-super-cool-btn">
                            <h1>Chat !</h1>
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <h1 class="text-center">Notification ( {{ Auth::User()->unreadNotifications->count() }} )</h1>

        <div class="py-12 overflow-y-scroll">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div  class="p-6 bg-white border-b border-gray-200">
                        <a href="{{ route('Read_all_notification')}}">
                            <h6 class="text-center" id="wrapper" style="color:brown">Mark As Read</h6>
                        </a>
                    </div>
                        @foreach (Auth::User()->unreadNotifications as $notification)
                            <div class="p-6 bg-white border-b border-gray-200">

                                <div id="wrapper" style="color: red">{{ $notification->data['create_at'] }}</div>

                                <a href="{{ route('Read_notification_message', $notification->data['message_id']) }}">
                                    <h6 id="wrapper" style="color:blue">{{ $notification->data['message_text'] }}</h6>
                                </a>

                                <div id="wrapper">{{ $notification->created_at->diffForHumans(null, false, false) }}</div>

                            </div>
                        @endforeach
                    </div>
                </div>

        </div>

</x-app-layout>
