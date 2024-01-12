      <!--**********************************
            Sidebar start
        ***********************************-->
      <div class="deznav">
          <div class="deznav-scroll">
              <ul class="metismenu" id="menu">
                  <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                          <i class="flaticon-025-dashboard"></i>
                          <span class="nav-text">Основное</span>
                      </a>
                      <ul aria-expanded="false">
                          {{-- <li><a href="{{ route('pages.home') }}">Главный экран</a></li> --}}
                          <li @if (request()->routeIs('pages.objects.*') ||
                                  request()->routeIs('pages.object-parts.*') ||
                                  request()->routeIs('pages.part-user.*')) class="mm-active" @endif>
                              <a href="{{ route('pages.objects.index') }}"
                                  @if (request()->routeIs('pages.objects.*') ||
                                          request()->routeIs('pages.object-parts.*') ||
                                          request()->routeIs('pages.part-user.*')) class="active mm-active" @endif>Объекты</a>
                          </li>
                      </ul>

                  </li>
                  @if (auth()->user()->rule_id < 3)
                      <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                              <i class="flaticon-022-copy"></i>
                              <span class="nav-text">Справочники</span>
                          </a>
                          <ul aria-expanded="false">
                              <li @if (request()->routeIs('pages.users.*')) class="mm-active" @endif>
                                  <a href="{{ route('pages.users.index') }}"
                                      @if (request()->routeIs('pages.users.*')) class="active mm-active" @endif>Пользователи</a>
                              </li>
                              <li @if (request()->routeIs('pages.clients.*')) class="mm-active" @endif>
                                  <a href="{{ route('pages.clients.index') }}"
                                      @if (request()->routeIs('pages.clients.*')) class="active mm-active" @endif>Клиенты</a>
                              </li>
                              <li @if (request()->routeIs('pages.speciality.*')) class="mm-active" @endif>
                                  <a href="{{ route('pages.speciality.index') }}"
                                      @if (request()->routeIs('pages.speciality.*')) class="active mm-active" @endif>Специальности</a>
                              </li>
                              <li @if (request()->routeIs('pages.parts.*')) class="mm-active" @endif>
                                  <a href="{{ route('pages.parts.index') }}"
                                      @if (request()->routeIs('pages.parts.*')) class="active mm-active" @endif>Разделы</a>
                              </li>
                              <li @if (request()->routeIs('pages.stages.*')) class="mm-active" @endif>
                                  <a href="{{ route('pages.stages.index') }}"
                                      @if (request()->routeIs('pages.stages.*')) class="active mm-active" @endif>Стадии</a>
                              </li>
                              <li @if (request()->routeIs('pages.statuses.*')) class="mm-active" @endif>
                                  <a href="{{ route('pages.statuses.index') }}"
                                      @if (request()->routeIs('pages.statuses.*')) class="active mm-active" @endif>Статусы</a>
                              </li>
                              <li @if (request()->routeIs('pages.rules.*')) class="mm-active" @endif>
                                  <a href="{{ route('pages.rules.index') }}"
                                      @if (request()->routeIs('pages.rules.*')) class="active mm-active" @endif>Права
                                      доступа</a>
                              </li>
                          </ul>
                      </li>
                  @endif
              </ul>
              <div class="copyright">
                  <p><strong>ERP-project</strong> © 2020 - <?= date('Y') ?><br>Все права защищены<br>версия
                      1.1.2
                  </p>
              </div>
          </div>
      </div>
      <!--**********************************
            Sidebar end
        ***********************************-->
