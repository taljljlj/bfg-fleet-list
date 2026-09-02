@if($fleet)
    <div id="fleet_share_modal" class="fixed z-50 top-1/2 left-1/2 -translate-1/2 hidden">
        <div class="section-dark">
            <div id="fleet_share_modal_close_btn" class="absolute text-2xl top-2 right-3 cursor-pointer opacity-80 hover:opacity-100 hover:text-shadow-[0_0_10px_#c8c5dc]">
                ✖
            </div>
            <div class="m-6 align-middle flex flex-row">
                <div class="relative">
                    <input id="fleet_share_url_input" name="share-url" type="text" readonly value="{{ route('builder.view', $fleet) }}" class="bfi-input light-input w-100 text-center text-xl p-2">
                    <div id="fleet_share_url_input_overlay"
                         class="absolute w-full h-full top-0 left-0 text-2xl p-2 bg-primary-500-opc-80 border-2 border-secondary rounded text-shadow-[0_0_15px_#2d3748] invisible"
                    >
                        Copied!
                    </div>
                </div>
                <div id="copy_to_clipboard_btn" class="ml-3 h-10">
                    <img src="{{ asset('images/fleet-builder/copy-icon.png') }}" alt="Copy Icon" class="cursor-pointer opacity-60 hover:opacity-80 hover:drop-shadow-[0_0_15px_#c8c5dc]">
                </div>
            </div>
            <div class="flex flex-col mb-6">
                <div class="flex justify-between px-6">
                    <!-- Facebook -->
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('builder.view', $fleet) }}"
                       target="_blank"
                       class="bfi-share-links">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 256 256" xml:space="preserve">
                            <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                <circle cx="45" cy="45" r="45" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(93 123 181); fill-rule: nonzero; opacity: 1;" transform="  matrix(1 0 0 1 0 0) "/>
                                <path d="M 38.633 37.184 v 9.136 h -10.64 v 12.388 h 10.64 v 30.836 C 40.714 89.838 42.838 90 45 90 c 2.159 0 4.28 -0.162 6.359 -0.456 V 58.708 h 10.613 l 1.589 -12.388 H 51.359 v -7.909 c 0 -3.587 0.991 -6.031 6.107 -6.031 l 6.525 -0.003 v -11.08 c -1.128 -0.151 -5.002 -0.488 -9.508 -0.488 C 45.074 20.81 38.633 26.582 38.633 37.184 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/>
                            </g>
                        </svg>
                        <div>Facebook</div>
                    </a>

                    <!-- Messenger -->
                    <a href="https://www.facebook.com/dialog/send?link={{ route('builder.view', $fleet) }}&app_id={{ config('services.facebook.client_id') }}&redirect_uri={{ route('builder.view', $fleet) }}"
                       target="_blank"
                       class="bfi-share-links">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 256 256" xml:space="preserve">
                            <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                <path d="M 45 0 C 20.38 0 0.422 18.683 0.422 41.73 c 0 12.898 6.253 24.426 16.074 32.08 V 90 l 15.42 -8.371 c 4.138 1.188 8.531 1.83 13.084 1.83 c 24.62 0 44.578 -18.683 44.578 -41.73 C 89.578 18.683 69.62 0 45 0 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(249,249,249); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/>
                                <polygon points="18.63,54.94 41.44,31.06 52.48,41.75 71.37,32.13 50.52,54.94 38.76,43.89 " style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,132,255); fill-rule: nonzero; opacity: 1;" transform="  matrix(1 0 0 1 0 0) "/>
                            </g>
                        </svg>
                        <div>Messenger</div>
                    </a>

                    <!-- X (Twitter) -->
                    <a href="https://twitter.com/intent/tweet?url={{ route('builder.view', $fleet) }}"
                       target="_blank"
                       class="bfi-share-links">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 256 256" xml:space="preserve">
                            <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                <polygon points="24.89,23.01 57.79,66.99 65.24,66.99 32.34,23.01 " style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform="  matrix(1 0 0 1 0 0) "/>
                                <path d="M 45 0 L 45 0 C 20.147 0 0 20.147 0 45 v 0 c 0 24.853 20.147 45 45 45 h 0 c 24.853 0 45 -20.147 45 -45 v 0 C 90 20.147 69.853 0 45 0 z M 56.032 70.504 L 41.054 50.477 L 22.516 70.504 h -4.765 L 38.925 47.63 L 17.884 19.496 h 16.217 L 47.895 37.94 l 17.072 -18.444 h 4.765 L 50.024 40.788 l 22.225 29.716 H 56.032 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/>
                            </g>
                        </svg>
                        <div>X</div>
                    </a>

                    <!-- Reddit -->
                    <a href="https://www.reddit.com/submit?url={{ route('builder.view', $fleet) }}"
                       target="_blank"
                       class="bfi-share-links">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 256 256" xml:space="preserve">
                            <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                <circle cx="45" cy="45" r="45" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,69,0); fill-rule: nonzero; opacity: 1;" transform="  matrix(1 0 0 1 0 0) "/>
                                <path d="M 75.011 45 c -0.134 -3.624 -3.177 -6.454 -6.812 -6.331 c -1.611 0.056 -3.143 0.716 -4.306 1.823 c -5.123 -3.49 -11.141 -5.403 -17.327 -5.537 l 2.919 -14.038 l 9.631 2.025 c 0.268 2.472 2.483 4.262 4.955 3.993 c 2.472 -0.268 4.262 -2.483 3.993 -4.955 s -2.483 -4.262 -4.955 -3.993 c -1.421 0.145 -2.696 0.973 -3.4 2.204 L 48.68 17.987 c -0.749 -0.168 -1.499 0.302 -1.667 1.063 c 0 0.011 0 0.011 0 0.022 l -3.322 15.615 c -6.264 0.101 -12.36 2.025 -17.55 5.537 c -2.64 -2.483 -6.801 -2.36 -9.284 0.291 c -2.483 2.64 -2.36 6.801 0.291 9.284 c 0.515 0.481 1.107 0.895 1.767 1.186 c -0.045 0.66 -0.045 1.32 0 1.98 c 0 10.078 11.745 18.277 26.23 18.277 c 14.485 0 26.23 -8.188 26.23 -18.277 c 0.045 -0.66 0.045 -1.32 0 -1.98 C 73.635 49.855 75.056 47.528 75.011 45 z M 30.011 49.508 c 0 -2.483 2.025 -4.508 4.508 -4.508 c 2.483 0 4.508 2.025 4.508 4.508 s -2.025 4.508 -4.508 4.508 C 32.025 53.993 30.011 51.991 30.011 49.508 z M 56.152 62.058 v -0.179 c -3.199 2.405 -7.114 3.635 -11.119 3.468 c -4.005 0.168 -7.919 -1.063 -11.119 -3.468 c -0.425 -0.515 -0.347 -1.286 0.168 -1.711 c 0.447 -0.369 1.085 -0.369 1.544 0 c 2.707 1.98 6.007 2.987 9.362 2.83 c 3.356 0.179 6.667 -0.783 9.407 -2.74 c 0.492 -0.481 1.297 -0.47 1.779 0.022 C 56.655 60.772 56.644 61.577 56.152 62.058 z M 55.537 54.34 c -0.078 0 -0.145 0 -0.224 0 l 0.034 -0.168 c -2.483 0 -4.508 -2.025 -4.508 -4.508 s 2.025 -4.508 4.508 -4.508 s 4.508 2.025 4.508 4.508 C 59.955 52.148 58.02 54.239 55.537 54.34 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/>
                            </g>
                        </svg>
                        <div>Reddit</div>
                    </a>

                    <!-- WhatsApp -->
                    <a href="https://api.whatsapp.com/send?text={{ route('builder.view', $fleet) }}"
                       target="_blank"
                       class="bfi-share-links">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 256 256" xml:space="preserve">
                            <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                <path d="M 2.113 44.609 c -0.003 7.587 1.98 14.994 5.749 21.524 l -6.11 22.31 l 22.83 -5.986 c 6.29 3.428 13.372 5.237 20.58 5.24 h 0.019 c 23.736 0 43.056 -19.315 43.066 -43.053 c 0.005 -11.504 -4.471 -22.32 -12.603 -30.459 C 67.514 6.047 56.702 1.563 45.18 1.558 c -23.737 0 -43.057 19.312 -43.067 43.052" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(42,181,64); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/>
                                <path d="M 0.576 44.596 C 0.573 52.456 2.626 60.129 6.53 66.892 L 0.201 90 l 23.65 -6.201 c 6.516 3.553 13.852 5.426 21.318 5.429 h 0.019 c 24.586 0 44.601 -20.009 44.612 -44.597 c 0.004 -11.917 -4.633 -23.122 -13.055 -31.552 C 68.321 4.65 57.121 0.005 45.188 0 C 20.597 0 0.585 20.005 0.575 44.595 M 14.658 65.727 l -0.883 -1.402 c -3.712 -5.902 -5.671 -12.723 -5.669 -19.726 C 8.115 24.161 24.748 7.532 45.201 7.532 c 9.905 0.004 19.213 3.865 26.215 10.871 c 7.001 7.006 10.854 16.32 10.851 26.224 c -0.009 20.439 -16.643 37.068 -37.08 37.068 h -0.015 c -6.655 -0.004 -13.181 -1.79 -18.872 -5.168 l -1.355 -0.803 l -14.035 3.68 L 14.658 65.727 z M 45.188 89.228 L 45.188 89.228 L 45.188 89.228 C 45.187 89.228 45.187 89.228 45.188 89.228" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(251,251,251); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/>
                                <path d="M 34.038 25.95 c -0.835 -1.856 -1.714 -1.894 -2.508 -1.926 c -0.65 -0.028 -1.394 -0.026 -2.136 -0.026 c -0.744 0 -1.951 0.279 -2.972 1.394 c -1.022 1.116 -3.902 3.812 -3.902 9.296 c 0 5.485 3.995 10.784 4.551 11.529 c 0.558 0.743 7.712 12.357 19.041 16.825 c 9.416 3.713 11.333 2.975 13.376 2.789 c 2.044 -0.186 6.595 -2.696 7.524 -5.299 c 0.929 -2.603 0.929 -4.834 0.651 -5.299 c -0.279 -0.465 -1.022 -0.744 -2.137 -1.301 c -1.115 -0.558 -6.595 -3.254 -7.617 -3.626 c -1.022 -0.372 -1.765 -0.557 -2.509 0.559 c -0.743 1.115 -2.878 3.625 -3.528 4.368 c -0.65 0.745 -1.301 0.838 -2.415 0.28 c -1.115 -0.559 -4.705 -1.735 -8.964 -5.532 c -3.314 -2.955 -5.551 -6.603 -6.201 -7.719 c -0.65 -1.115 -0.069 -1.718 0.489 -2.274 c 0.501 -0.499 1.115 -1.301 1.673 -1.952 c 0.556 -0.651 0.742 -1.116 1.113 -1.859 c 0.372 -0.744 0.186 -1.395 -0.093 -1.953 C 37.195 33.666 35.029 28.154 34.038 25.95" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(251,251,251); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/>
                            </g>
                        </svg>
                        <div>WhatsApp</div>
                    </a>

                    <!-- Viber -->
                    <a href="viber://forward?text={{ route('builder.view', $fleet) }}"
                       class="bfi-share-links">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 256 256" xml:space="preserve">
                            <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                <path d="M 78.042 8.778 c -2.237 -2.064 -11.275 -8.625 -31.406 -8.714 c 0 0 -23.74 -1.432 -35.313 9.184 C 4.881 15.692 2.615 25.12 2.376 36.809 C 2.137 48.499 1.827 70.405 22.943 76.344 h 0.02 l -0.013 9.064 c 0 0 -0.135 3.669 2.281 4.418 c 2.923 0.908 4.638 -1.881 7.428 -4.888 c 1.531 -1.65 3.646 -4.075 5.24 -5.928 c 14.442 1.215 25.549 -1.563 26.81 -1.973 c 2.916 -0.945 19.416 -3.06 22.099 -24.964 C 89.579 29.496 85.469 15.215 78.042 8.778 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(142 127 237); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/>
                                <path d="M 65.906 57.835 c 0 0.009 -0.007 0.026 -0.007 0.034 c -0.93 1.612 -2.11 3.065 -3.497 4.306 c -0.016 0.008 -0.016 0.016 -0.031 0.024 c -1.205 1.007 -2.388 1.579 -3.551 1.717 c -0.171 0.03 -0.345 0.041 -0.519 0.032 c -0.513 0.005 -1.023 -0.073 -1.51 -0.232 l -0.038 -0.055 c -1.791 -0.505 -4.781 -1.769 -9.761 -4.516 c -2.882 -1.571 -5.625 -3.383 -8.201 -5.417 c -1.291 -1.019 -2.522 -2.111 -3.688 -3.271 l -0.124 -0.124 l -0.124 -0.124 l -0.124 -0.124 c -0.042 -0.04 -0.082 -0.082 -0.124 -0.124 c -1.16 -1.166 -2.252 -2.397 -3.271 -3.688 c -2.034 -2.575 -3.846 -5.318 -5.417 -8.199 c -2.747 -4.981 -4.011 -7.968 -4.516 -9.762 l -0.055 -0.038 c -0.158 -0.487 -0.236 -0.997 -0.231 -1.51 c -0.009 -0.173 0.001 -0.347 0.031 -0.519 c 0.145 -1.161 0.718 -2.345 1.719 -3.553 c 0.008 -0.015 0.016 -0.015 0.024 -0.031 c 1.24 -1.387 2.694 -2.567 4.306 -3.495 c 0.008 0 0.024 -0.008 0.034 -0.008 c 1.621 -0.844 3.158 -0.558 4.203 0.675 c 0.008 0.008 2.176 2.611 3.106 3.882 c 0.958 1.348 1.848 2.742 2.666 4.179 c 1.067 1.914 0.398 3.873 -0.65 4.681 l -2.114 1.68 c -1.067 0.862 -0.926 2.462 -0.926 2.462 s 3.131 11.849 14.828 14.835 c 0 0 1.6 0.135 2.462 -0.927 l 1.68 -2.114 c 0.81 -1.048 2.766 -1.717 4.681 -0.65 c 1.435 0.818 2.828 1.708 4.175 2.666 c 1.271 0.935 3.873 3.106 3.881 3.106 C 66.464 54.677 66.75 56.214 65.906 57.835 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/>
                                <path d="M 46.309 24.289 c -0.627 -0.046 -1.098 -0.592 -1.052 -1.219 c 0.046 -0.627 0.594 -1.099 1.219 -1.052 c 4.845 0.355 8.692 2.052 11.433 5.043 c 2.747 3.002 4.091 6.777 3.995 11.22 c -0.013 0.62 -0.52 1.114 -1.138 1.114 c -0.008 0 -0.017 0 -0.025 0 c -0.629 -0.014 -1.127 -0.534 -1.114 -1.163 c 0.084 -3.891 -1.027 -7.042 -3.398 -9.633 C 53.86 26.015 50.615 24.605 46.309 24.289 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/>
                                <path d="M 56.061 36.243 c 0.031 0.628 -0.453 1.162 -1.081 1.193 c -0.019 0.001 -0.038 0.001 -0.057 0.001 c -0.603 0 -1.106 -0.473 -1.136 -1.082 c -0.192 -3.869 -2.011 -5.761 -5.726 -5.955 c -0.628 -0.033 -1.11 -0.568 -1.078 -1.196 c 0.033 -0.628 0.566 -1.112 1.196 -1.078 C 53.084 28.383 55.81 31.189 56.061 36.243 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/>
                                <path d="M 66.754 41.735 c -0.003 0 -0.006 0 -0.009 0 c -0.625 0 -1.134 -0.504 -1.138 -1.13 c -0.052 -6.869 -2.114 -12.336 -6.127 -16.248 c -4.021 -3.92 -9.102 -5.929 -15.103 -5.97 c -0.629 -0.004 -1.135 -0.518 -1.131 -1.146 c 0.004 -0.626 0.513 -1.131 1.138 -1.131 c 0.003 0 0.005 0 0.008 0 c 6.609 0.046 12.22 2.272 16.676 6.617 c 4.465 4.352 6.757 10.362 6.814 17.861 C 67.888 41.217 67.382 41.73 66.754 41.735 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/>
                            </g>
                        </svg>
                        <div>Viber</div>
                    </a>

                    <!-- Telegram -->
                    <a href="https://t.me/share/url?url={{ route('builder.view', $fleet) }}"
                       target="_blank"
                       class="bfi-share-links">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 256 256" xml:space="preserve">
                            <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                <linearGradient id="SVGID_1" gradientUnits="userSpaceOnUse" x1="58.19" y1="75.759" x2="35.69" y2="23.289">
                                    <stop offset="0%" style="stop-color:rgb(55,174,226);stop-opacity: 1"/>
                                    <stop offset="100%" style="stop-color:rgb(30,150,200);stop-opacity: 1"/>
                                </linearGradient>
                                <circle cx="45" cy="45" r="45" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: url(#SVGID_1); fill-rule: nonzero; opacity: 1;" transform="  matrix(1 0 0 1 0 0) "/>
                                <path d="M 36.75 65.625 c -1.458 0 -1.21 -0.55 -1.713 -1.939 L 30.75 49.578 L 63.75 30" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(200,218,234); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/>
                                <path d="M 36.75 65.625 c 1.125 0 1.622 -0.514 2.25 -1.125 l 6 -5.834 l -7.484 -4.513" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(169,201,221); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/>
                                <path d="M 37.515 54.154 L 55.65 67.552 c 2.07 1.142 3.563 0.551 4.079 -1.921 l 7.382 -34.786 c 0.756 -3.03 -1.155 -4.405 -3.135 -3.506 L 20.629 44.053 c -2.959 1.187 -2.941 2.838 -0.539 3.573 l 11.124 3.472 l 25.752 -16.247 c 1.216 -0.737 2.332 -0.341 1.416 0.472 L 37.515 54.154 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(252,253,255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/>
                            </g>
                        </svg>
                        <div>Telegram</div>
                    </a>

                    <!-- Email -->
                    <a href="mailto:?subject=Check this out&body={{ route('builder.view', $fleet) }}"
                       target="_blank"
                       class="bfi-share-links">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 256 256" xml:space="preserve">
                            <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                <circle cx="45" cy="45" r="45" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(96 151 192); fill-rule: nonzero; opacity: 1;" transform="  matrix(1 0 0 1 0 0) "/>
                                <polygon points="21.07,31.48 36.59,45.44 21.07,58.53 " style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform="  matrix(1 0 0 1 0 0) "/>
                                <polygon points="45,48.97 23.68,29.79 66.32,29.79 " style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform="  matrix(1 0 0 1 0 0) "/>
                                <path d="M 38.842 47.465 l 5.155 4.637 c 0.286 0.257 0.645 0.385 1.003 0.385 s 0.718 -0.128 1.003 -0.385 l 5.155 -4.637 l 15.1 12.743 H 23.741 L 38.842 47.465 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/>
                                <polygon points="53.41,45.44 68.93,31.48 68.93,58.53 " style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform="  matrix(1 0 0 1 0 0) "/>
                            </g>
                        </svg>
                        <div>Email</div>
                    </a>
                </div>

            </div>
        </div>
    </div>
@endif

@push('scripts')
    <script data-origin="fleet-share-modal">
        document.getElementById('copy_to_clipboard_btn').addEventListener('click', () => {
            const input = document.getElementById('fleet_share_url_input');
            const overlay = document.getElementById('fleet_share_url_input_overlay');
            navigator.clipboard.writeText(input.value)
                .then(() => {
                    console.log('Copied to clipboard:', input.value);

                    // trigger overlay animation
                    overlay.classList.remove('invisible');
                    overlay.classList.add('animate-input-overlay');

                    overlay.addEventListener('animationend', () => {
                        overlay.classList.add('invisible');
                        overlay.classList.remove('animate-input-overlay');
                    }, { once:true });
                })
                .catch(err => {
                    console.error('Failed to copy:', err);
                });
        });
    </script>
@endpush
