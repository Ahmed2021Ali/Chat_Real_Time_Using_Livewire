<div wire:poll>
    <div id="chat" class="container-fluid h-100">
        <div class="row justify-content-center h-100">
            <div class="col-md-8 col-xl-6 chat">
                <div class="card" id="chat">
                    <div class="card-header msg_head" >
                        <div class="d-flex bd-highlight">

                            <div class="img_cont">
                                <img src="{{ asset('storage/' . auth()->user()->image) }}"
                                    class="rounded-circle user_img">
                                <span class="online_icon"></span>
                            </div>

                            <div class="user_info">
                                <span>{{ auth()->user()->name }}</span>
                                <p>{{ date('F j, Y') }}</p>
                            </div>

                        </div>

                    </div>

                    <div id="chat" class="card-body msg_card_body">
                        @forelse ($messages as $message)
                            @if ($message->user->id == auth()->user()->id)
                                <div class="d-flex justify-content-start mb-4" id="chat">
                                    <div class="img_cont_msg">
                                        <img src="{{ asset('storage/' . auth()->user()->image) }}"
                                            class="rounded-circle user_img_msg">
                                    </div>
                                    <div class="msg_cotainer" id="chat">

                                        {{ $message->message_text }}
                                        <span
                                            class="msg_time">{{ $message->created_at->diffForHumans(null, false, false) }}
                                        </span>
                                        <span>
                                            <a wire:click="delete_massage({{ $message->id }}, '{{ $message->file }}')"
                                                class="delete-message-btn" title="Delete Message">
                                                <span style="display: inline-block; cursor: pointer; color: black;"
                                                    onmouseover="this.style.color='red'"
                                                    onmouseout="this.style.color='black'">
                                                    &#10005;
                                                </span>
                                            </a>
                                        </span>
                                        @if ($message->file)
                                            @if (Str::contains($message->file, ['.jpg', '.jpeg', '.png', '.gif']))
                                                <img src="{{ asset('storage/' . $message->file) }}"
                                                    alt="Message Attachment" class="img-thumbnail"
                                                    style="width: 200px; height: 200px;">
                                            @elseif (Str::contains($message->file, ['.pdf']))
                                                <iframe src="{{ storage_path() . '/public/photos/' . $message->file }}"
                                                    style="width: 200px; height: 200px;"></iframe>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="d-flex justify-content-end mb-4">
                                    <div class="msg_cotainer_send">
                                        {{ $message->message_text }}
                                        <span
                                            class="msg_time_send">{{ $message->created_at->diffForHumans(null, false, false) }}
                                        </span>
                                        @if ($message->file)
                                            @if (Str::contains($message->file, ['.jpg', '.jpeg', '.png', '.gif']))
                                                <img src="{{ asset('storage/' . $message->file) }}"
                                                    alt="Message Attachment" class="img-thumbnail"
                                                    style="width: 200px; height: 200px;">
                                            @elseif (Str::contains($message->file, ['.pdf']))
                                                <iframe src="{{ storage_path() . '/public/photos/' . $message->file }}"
                                                    style="width: 200px; height: 200px;"></iframe>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="img_cont_msg">
                                        <img src="{{ asset('storage/' . $message->user->image) }}"
                                            class="rounded-circle user_img_msg">
                                    </div>
                                </div>
                            @endif
                        @empty
                            <h5 style="text-align: center;color:red"> لاتوجد رسائل سابقة</h5>
                        @endforelse
                    </div>
                    <div id="chat" class="card-footer">

                        <form wire:submit.prevent="sendMessage" class="w-100">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text attach_btn">
                                        <input type="file" wire:model="photo" />
                                    </span>
                                </div>
                                <input onkeydown='scrollDown()' wire:model.defer="message_text" type="text"
                                    class="form-control type_msg" placeholder="Type your message..." />

                                <button class="btn btn-warning rounded-pill py-2" type="submit"
                                    style="box-shadow: none;">
                                    <div class="input-group-append">
                                        <span class="input-group-text send_btn"><i
                                                class="fas fa-location-arrow"></i></span>
                                    </div>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
