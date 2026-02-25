<aside class="hidden lg:flex lg:w-72 lg:flex-col lg:fixed lg:inset-y-0">
    <div class="flex flex-col h-full border-r border-slate-200 bg-white">
        <div class="px-6 py-6 flex items-center gap-3">
            <div class="h-10 w-10 rounded-2xl bg-sky-600 text-white flex items-center justify-center font-bold">
                C
            </div>
            <div>
                <p class="text-sm font-semibold">Company Portal</p>
                <p class="text-xs text-slate-500">Recruitment Suite</p>
            </div>
        </div>

        <nav class="px-3 space-y-1">
            <a href="{{ route('company.dashboard') }}"
                class="flex items-center gap-3 rounded-xl px-3 py-2.5 font-semibold
               {{ request()->routeIs('company.dashboard')
                    ? 'bg-sky-50 text-sky-700'
                    : 'text-slate-700 hover:bg-slate-50' }}">
                Dashboard
            </a>
            <a href="{{ route('company.jobs.index') }}"
                class="flex items-center gap-3 rounded-xl px-3 py-2.5 font-semibold
               {{ request()->routeIs('company.jobs.*')
                    ? 'bg-sky-50 text-sky-700'
                    : 'text-slate-700 hover:bg-slate-50' }}">
                Jobs
            </a>
            <a href="{{ route('company.candidates.index') }}"
                class="flex items-center gap-3 rounded-xl px-3 py-2.5 font-semibold
               {{ request()->routeIs('company.candidates.*')
                    ? 'bg-sky-50 text-sky-700'
                    : 'text-slate-700 hover:bg-slate-50' }}">
                Candidates
            </a>

            <a href="{{route('company.interviews.index')}}"
                class="flex items-center gap-3 rounded-xl px-3 py-2.5 font-semibold
               {{ request()->routeIs('company.interviews.*')
                    ? 'bg-sky-50 text-sky-700'
                    : 'text-slate-700 hover:bg-slate-50' }}">
                Interviews
            </a>
            <a href="#"
                class="flex items-center gap-3 rounded-xl px-3 py-2.5 font-semibold
               {{ request()->routeIs('company.settings.*')
                    ? 'bg-sky-50 text-sky-700'
                    : 'text-slate-700 hover:bg-slate-50' }}">
                Settings
            </a>

        </nav>
        <div class="mt-auto px-6 py-6 border-t border-slate-200">
            <p class="text-sm font-semibold">Acme Hiring</p>
            <p class="text-xs text-slate-500">hr@acme.com</p>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="mt-4 w-full rounded-xl border px-4 py-2 hover:bg-slate-50">
                    Log out
                </button>
            </form>
        </div>

    </div>
</aside>