@extends('main')
@section('contant')
    <div class="container">
        {{-- start --}}

        <div id="frame">
            <div id="sidepanel">
                <div id="profile">
                    <div class="wrap">
                        @if (auth()->user()->image == '')
                            <img id="profile-img" src="{{ asset('images/no-image.jpeg') }}" class="online" alt="" />
                        @else
                            <img id="profile-img" src="{{ asset('images/' . auth()->user()->image) }}" class="online"
                                alt="" />
                        @endif
                        <a href="{{ route('setting') }}" class="ml-5"><i class="fa-solid fa-gear"></i></a>
                        <p>{{ auth()->user()->name }}</p>
                    </div>
                </div>
                <div id="search">
                    <label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
                    <input type="text"name="search" placeholder="Search contacts..." />
                </div>
                {{-- start user --}}\
                <div id="contacts">
                    <ul>
                        @foreach ($read as $item)
                            <li class="contact" onclick="openUserConversation({{ $item }})">
                                <div class="wrap">
                                    <span class="contact-status"></span>
                                    @if ($item->image == '')
                                        <img src="{{ asset('images/no-image.jpeg') }}" alt="image" />
                                    @else
                                        <img src="{{ asset('images/' . $item->image) }}" alt="" />
                                    @endif
                                    <div class="meta">
                                        <p class="name">{{ $item->name }}</p>
                                        <p class="preview">Mike, this isn't over.</p>

                                    </div>



                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                {{-- end user --}}
            </div>
            <div class="content">
                <div class="contact-profile">
                    <img src="http://emilcarlsson.se/assets/harveyspecter.png"alt="" />
                    {{-- show name  --}}
                    <p id="name">Harvey Specter</p>
                    {{-- show name  --}}
                </div>
                {{-- msg start  --}}
                <div class="messages">
                    <ul id="conversation">

                    </ul>
                </div>
                {{-- msg end  --}}
                {{-- input msg  --}}
                <div class="message-input">
                    <div class="wrap">
                        <input type="text" name="message" id="message" placeholder="Write your message..." />
                        {{-- textarea  --}}
                        {{-- end  --}}
                        <i class="fa fa-paperclip attachment" aria-hidden="true"></i>
                        <button class="submit" onclick="sendMessage()"><i class="fa fa-paper-plane"
                                aria-hidden="true"></i></button>
                    </div>
                    {{-- end input msg  --}}
                </div>
            </div>
        </div>

        {{-- end  --}}
    </div>
    <script>
        var auth_id = {{ auth()->user()->id }} //get auth id
        var receiver_id; // var for  receiver id


        function openUserConversation(user) { //when onclick function call
            var name = document.getElementById("name").innerHTML = user.name; //get this data
            receiver_id = user.id; //get receiver id


            var conversationList = document.getElementById("conversation"); //get conversation id
            conversationList.innerHTML = '' // if message is null

            const base_url_endpoint = "{{ route('fetchmsg') }}"; //api url
            const url = new URL(base_url_endpoint);
            url.searchParams.append('id', user.id); // Add auth_id as a query parameter


            // test api
            fetch(url) //fetch api
                .then((response) => response.json()).then((response) => {
                    for (var i = 0; i < response.length; i++) { //loop for message
                        var listItem = document.createElement("li"); //list item create by js
                        listItem.classList.add("sent");

                        // Set the text content of the <li> element to the message
                        listItem.textContent = response[i].message; //show message
                        if (response[i].receiver_id == auth_id) {
                            listItem.style.backgroundColor = "lightblue";
                        } else {
                            listItem.style.backgroundColor = "yellow";
                        }


                        // Append the <li> element to the <ul> element
                        conversationList.appendChild(listItem);
                    }


                });
        }
        // start post request
        // Define the URL for the POST request
        const url = "{{ route('insertmsg') }}"; //fetch post url 
        const csrfToken = '{{ csrf_token() }}';   //token 


        function sendMessage() { // when click send submit button
            var sendmsg = document.getElementById("message").value; //get message input value
            // Define the data you want to send as the request body
            const data = {
                message: sendmsg, //message var
                _token: csrfToken, // token
                receiver_id: receiver_id, 
                sender_id: auth_id
            };

            // Create an options object for the fetch request
            const options = {
                method: 'POST', // HTTP method
                headers: {
                    'Content-Type': 'application/json' // Specify the content type
                    // You can also add other headers here if needed
                },
                body: JSON.stringify(data) // Convert the data to a JSON string
            };
            // Use the fetch() function to send the POST request
            fetch(url, options)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json(); // Parse the response JSON
                })
                .then(data => {
                    // Handle the response data here
                    console.log(data);
                })
                .catch(error => {
                    // Handle any errors that occurred during the fetch
                    console.error('Fetch error:', error);
                });

        }
        // end post request
        //onclick send message
        $('.submit').click(function() { // click submit button send message
            newMessage();
        });
    </script>
@endsection
