<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>
<body class="apanel">
<div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
    @if (Route::has('login'))
    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10 header">
        <div class="welcome">
            <a href="{{ url('/') }}" class="welcome font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Welcome</a>
        </div>
        <div class="links">
            @auth
                {{--@if(Auth()->user()->role == 'admin')
                    <a href="{{ url('/adminpanel') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">A Panel</a>
                @endif--}}
                <div aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                @endif
            @endauth
        </div>
    </div>
    @endif

        @if(Auth()->user()->role == 'admin')
            <main>

                <div class="choose">
                    <div class="title">Оберіть групу та категорію парсингу</div>
                    <div class="choose__group">
                        <label for="group">Виберіть групу</label>
                        <select  class="form-control" name="group" id="group">
                            <option selected disabled></option>
                            <option value="1">tmp 1</option>
                            <option value="2">tmp 2</option>
                        </select>
                    </div>
                    <div class="choose__category">
                        <div>
                            <label for="category">Виберіть категорію</label>
                            <select  class="form-control" name="category" id="category">
                                <option value="0">Квартира</option>
                                <option value="1">Кімната</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="filters apartment">
                    <div class="title">Фільтри</div>
                    <form class="form-control" action="#">

                        <div class="section">
                            <label><span class="l_title">Поверх</span>
                                <input class="form-control" list="floor_from_list" name="floor_from" id="floor_from" placeholder="Від:"/>
                                <datalist id="floor_from_list">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                    <option value="32">32</option>
                                    <option value="33">33</option>
                                    <option value="34">34</option>
                                    <option value="35">35</option>
                                    <option value="36">36</option>
                                    <option value="37">37</option>
                                    <option value="38">38</option>
                                    <option value="39">39</option>
                                    <option value="40">40</option>
                                    <option value="41">41</option>
                                    <option value="42">42</option>
                                    <option value="43">43</option>
                                    <option value="44">44</option>
                                    <option value="45">45</option>
                                    <option value="46">46</option>
                                    <option value="47">47</option>
                                    <option value="48">48</option>
                                    <option value="49">49</option>
                                    <option value="50">50</option>
                                </datalist>
                                <input class="form-control" list="floor_to_list" name="floor_to" id="floor_to" placeholder="до:"/>
                                <datalist id="floor_to_list">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                    <option value="32">32</option>
                                    <option value="33">33</option>
                                    <option value="34">34</option>
                                    <option value="35">35</option>
                                    <option value="36">36</option>
                                    <option value="37">37</option>
                                    <option value="38">38</option>
                                    <option value="39">39</option>
                                    <option value="40">40</option>
                                    <option value="41">41</option>
                                    <option value="42">42</option>
                                    <option value="43">43</option>
                                    <option value="44">44</option>
                                    <option value="45">45</option>
                                    <option value="46">46</option>
                                    <option value="47">47</option>
                                    <option value="48">48</option>
                                    <option value="49">49</option>
                                    <option value="50">50</option>
                                </datalist>
                            </label>
                        </div>

                        <div class="section">
                            <label><span class="l_title">Кількість кімнат</span>
                                <select class="form-control" name="room_count" id="room_count">
                                    <option value="0">Всі оголошення</option>
                                    <option value="1">1 кімната</option>
                                    <option value="2">2 кімнати</option>
                                    <option value="3">3 кімнати</option>
                                    <option value="4">4 кімнати</option>
                                    <option value="5">5 кімнат</option>
                                </select>
                            </label>
                        </div>

                        <div class="section">
                            <label><span class="l_title">Загальна площа м²</span>
                                <input class="form-control" list="total_area_from_list" name="total_area_from" id="total_area_from" placeholder="Від:"/>
                                <datalist id="total_area_from_list">
                                    <option value="20 м²">20 м²</option>
                                    <option value="30 м²">30 м²</option>
                                    <option value="40 м²">40 м²</option>
                                    <option value="50 м²">50 м²</option>
                                    <option value="60 м²">60 м²</option>
                                    <option value="70 м²">70 м²</option>
                                    <option value="80 м²">80 м²</option>
                                    <option value="90 м²">90 м²</option>
                                    <option value="100 м²">100 м²</option>
                                    <option value="200 м²">200 м²</option>
                                    <option value="300 м²">300 м²</option>
                                    <option value="400 м²">400 м²</option>
                                    <option value="500 м²">500 м²</option>
                                    <option value="600 м²">600 м²</option>
                                    <option value="700 м²">700 м²</option>
                                    <option value="800 м²">800 м²</option>
                                    <option value="900 м²">900 м²</option>
                                    <option value="1000 м²">1000 м²</option>
                                </datalist>
                                <input class="form-control" list="total_area_to_list" name="total_area_to" id="total_area_to" placeholder="до:"/>
                                <datalist id="total_area_to_list">
                                    <option value="20 м²">20 м²</option>
                                    <option value="30 м²">30 м²</option>
                                    <option value="40 м²">40 м²</option>
                                    <option value="50 м²">50 м²</option>
                                    <option value="60 м²">60 м²</option>
                                    <option value="70 м²">70 м²</option>
                                    <option value="80 м²">80 м²</option>
                                    <option value="90 м²">90 м²</option>
                                    <option value="100 м²">100 м²</option>
                                    <option value="200 м²">200 м²</option>
                                    <option value="300 м²">300 м²</option>
                                    <option value="400 м²">400 м²</option>
                                    <option value="500 м²">500 м²</option>
                                    <option value="600 м²">600 м²</option>
                                    <option value="700 м²">700 м²</option>
                                    <option value="800 м²">800 м²</option>
                                    <option value="900 м²">900 м²</option>
                                    <option value="1000 м²">1000 м²</option>
                                </datalist>
                            </label>
                        </div>

                        <div class="section">
                            <label><span class="l_title">Площа кухні м²</span>
                                <input class="form-control" list="kitchen_area_from_list" name="kitchen_area_from" id="kitchen_area_from" placeholder="Від:"/>
                                <datalist id="kitchen_area_from_list">
                                    <option value="5 м²">5 м²</option>
                                    <option value="10 м²">10 м²</option>
                                    <option value="15 м²">15 м²</option>
                                    <option value="20 м²">20 м²</option>
                                    <option value="25 м²">25 м²</option>
                                    <option value="30 м²">30 м²</option>
                                    <option value="35 м²">35 м²</option>
                                    <option value="40 м²">40 м²</option>
                                    <option value="45 м²">45 м²</option>
                                    <option value="50 м²">50 м²</option>
                                </datalist>
                                <input class="form-control" list="kitchen_area_to_list" name="kitchen_area_to" id="kitchen_area_to" placeholder="до:"/>
                                <datalist id="kitchen_area_to_list">
                                    <option value="5 м²">5 м²</option>
                                    <option value="10 м²">10 м²</option>
                                    <option value="15 м²">15 м²</option>
                                    <option value="20 м²">20 м²</option>
                                    <option value="25 м²">25 м²</option>
                                    <option value="30 м²">30 м²</option>
                                    <option value="35 м²">35 м²</option>
                                    <option value="40 м²">40 м²</option>
                                    <option value="45 м²">45 м²</option>
                                    <option value="50 м²">50 м²</option>
                                </datalist>
                            </label>
                        </div>

                    </form>
                </div>

            </main>
        @endif

</div>
</body>
</html>
