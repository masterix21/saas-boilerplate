<x-empty-layout>
    <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-4xl text-center">
                <h2 class="text-base/7 font-semibold text-indigo-600">{{ __('Subscribe') }}</h2>
                <p class="mt-2 text-balance text-5xl font-semibold tracking-tight text-gray-900 sm:text-6xl">
                    {{ __('Boost your Business') }}
                </p>
                <p class="mt-2 text-balance text-4xl font-semibold tracking-tight text-gray-700 sm:text-5xl">
                    {{ __('The SaaS platform that takes your business to the next level') }}
                </p>
            </div>
            <p class="mx-auto mt-6 max-w-2xl text-pretty text-center text-lg font-medium text-gray-600 sm:text-xl/8">
                {{ __('Clear pricing, no surprises') }}
            </p>
            <div class="mt-16 flex justify-center">
                <fieldset aria-label="Payment frequency">
                    <div class="grid grid-cols-2 gap-x-1 rounded-full p-1 text-center text-xs/5 font-semibold ring-1 ring-inset ring-gray-200">
                        <!-- Checked: "bg-indigo-600 text-white", Not Checked: "text-gray-500" -->
                        <label class="cursor-pointer rounded-full px-2.5 py-1">
                            <input type="radio" name="frequency" value="monthly" class="sr-only">
                            <span>Monthly</span>
                        </label>
                        <!-- Checked: "bg-indigo-600 text-white", Not Checked: "text-gray-500" -->
                        <label class="cursor-pointer rounded-full px-2.5 py-1">
                            <input type="radio" name="frequency" value="annually" class="sr-only">
                            <span>Annually</span>
                        </label>
                    </div>
                </fieldset>
            </div>
            <div class="isolate mx-auto mt-10 grid max-w-md grid-cols-1 gap-8 md:max-w-2xl md:grid-cols-2 lg:max-w-4xl xl:mx-0 xl:max-w-none xl:grid-cols-4">
                @foreach ($plans as $plan)
                    <div class="rounded-3xl p-8 ring-1 ring-gray-200">
                        <h3 id="tier-hobby" class="text-lg/8 font-semibold text-gray-900">{{ $plan->name }}</h3>
                        <p class="mt-4 text-sm/6 text-gray-600">The essentials to provide your best work for clients.</p>
                        <p class="mt-6 flex items-baseline gap-x-1">
                            <!-- Price, update based on frequency toggle state -->
                            <span class="text-4xl font-semibold tracking-tight text-gray-900">€ {{$plan->price}}</span>
                            <!-- Payment frequency, update based on frequency toggle state -->
                            <span class="text-sm/6 font-semibold text-gray-600">{{$plan->invoice_label}}</span>
                        </p>
                        <a href="#" aria-describedby="tier-hobby" class="mt-6 block rounded-md px-3 py-2 text-center text-sm/6 font-semibold text-indigo-600 ring-1 ring-inset ring-indigo-200 hover:ring-indigo-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Buy plan</a>
                        <ul role="list" class="mt-8 space-y-3 text-sm/6 text-gray-600">
                            <li class="flex gap-x-3">
                                <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                                </svg>
                                5 products
                            </li>
                            <li class="flex gap-x-3">
                                <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                                </svg>
                                Up to 1,000 subscribers
                            </li>
                            <li class="flex gap-x-3">
                                <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                                </svg>
                                Basic analytics
                            </li>
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</x-empty-layout>
