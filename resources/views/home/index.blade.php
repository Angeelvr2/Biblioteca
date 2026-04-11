@extends('layout.admin')

@section('content')
<!-- CONTENIDO PRINCIPAL (MAIN) semántico -->
        <main class="flex-1 p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto w-full">
            <!-- Encabezado de la página con título y acciones -->
            <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Panel de Administración</h1>
                    <p class="text-gray-500 mt-1">Gestiona usuarios, libros y préstamos de la biblioteca</p>
                </div>
                <div class="mt-4 sm:mt-0">
                    <a href="{{ route('libros.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 text-sm font-medium transition">
                        + Agregar Libro
                    </a>
                </div>
            </div>

            <!-- Ejemplo de tarjetas de resumen (dashboard) -->
            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8" aria-label="Resumen de actividad">
                <article class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow transition">
                    <div class="flex items-center">
                        <div class="p-3 bg-indigo-100 rounded-full text-indigo-700">
                            <i class="fas fa-users text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total de Usuarios</h2>
                            <p class="text-2xl font-semibold text-gray-800">{{ $total_usuarios }}</p>
                        </div>
                    </div>
                </article>
                <article class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow transition">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 rounded-full text-blue-700">
                            <i class="fas fa-book text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total de libros</h2>
                            <p class="text-2xl font-semibold text-gray-800">{{ $totalLibros }}</p>
                        </div>
                    </div>
                </article>
                <article class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow transition">
                    <div class="flex items-center">
                        <div class="p-3 bg-amber-100 rounded-full text-amber-700">
                            <i class="fas fa-clock text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Préstamos activos</h2>
                            <p class="text-2xl font-semibold text-gray-800">{{ $libros_prestados }}</p>
                        </div>
                    </div>
                </article>
                <article class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow transition">
                    <div class="flex items-center">
                        <div class="p-3 bg-amber-100 rounded-full text-amber-700">
                            <i class="fas fa-clock text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Devoluciones pendientes</h2>
                            <p class="text-2xl font-semibold text-gray-800">{{ $devoluciones_pendientes }}</p>
                        </div>
                    </div>
                </article>
            </section>

            <!-- Tabla de ejemplo (préstamos recientes) -->
            <section class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 sm:p-6">
                <header class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Préstamos recientes</h2>
                    <a href="#" class="text-indigo-600 text-sm hover:underline">Ver todos</a>
                </header>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Libro</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Autor</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ISBN</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoria</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($libros as $libro)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $libro->nombre }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $libro->autor }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $libro->isbn }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $libro->categoria->nombre }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($libro->estatus == 0)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Disponible</span></td>
                                    @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Prestado</span></td>
                                    @endif
                                <td class ="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('libros.edit', $libro->id) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                    <form action="{{ route('libros.destroy', $libro->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 ml-4">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>                   
                </div>
            </section>
        </main>
    </div>

    {{ $libros->links() }} <!-- Paginación de Laravel -->

    <!-- JavaScript vanilla para controlar el menú hamburguesa y overlay -->
    <script>
        (function() {
            const menuBtn = document.getElementById('menuBtn');
            const closeSidebarBtn = document.getElementById('closeSidebarBtn');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            // Función para abrir el sidebar (solo móvil)
            function openSidebar() {
                if (window.innerWidth < 1024) { // lg breakpoint de Tailwind
                    sidebar.classList.remove('sidebar-hidden');
                    sidebar.classList.add('translate-x-0');
                    overlay.classList.remove('hidden');
                    menuBtn?.setAttribute('aria-expanded', 'true');
                }
            }

            // Función para cerrar el sidebar
            function closeSidebar() {
                sidebar.classList.add('sidebar-hidden');
                sidebar.classList.remove('translate-x-0');
                overlay.classList.add('hidden');
                menuBtn?.setAttribute('aria-expanded', 'false');
            }

            // Toggle basado en estado actual (para botón hamburguesa)
            function toggleSidebar() {
                if (sidebar.classList.contains('sidebar-hidden') || sidebar.classList.contains('-translate-x-full')) {
                    openSidebar();
                } else {
                    closeSidebar();
                }
            }

            // Event listeners
            if (menuBtn) {
                menuBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    toggleSidebar();
                });
            }

            if (closeSidebarBtn) {
                closeSidebarBtn.addEventListener('click', closeSidebar);
            }

            if (overlay) {
                overlay.addEventListener('click', closeSidebar);
            }

            // Cerrar sidebar si se hace click en un enlace dentro del sidebar (opcional)
            const sidebarLinks = sidebar?.querySelectorAll('nav a');
            sidebarLinks?.forEach(link => {
                link.addEventListener('click', (e) => {
                    // Solo cerrar en móvil
                    if (window.innerWidth < 1024) {
                        closeSidebar();
                    }
                    // Aquí podrías prevenir navegación real si es una SPA, pero no es necesario.
                });
            });

            // Ajustar estado al redimensionar la ventana (cuando pasamos de móvil a desktop)
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 1024) {
                    // Modo desktop: aseguramos sidebar visible y overlay oculto
                    sidebar.classList.remove('sidebar-hidden', '-translate-x-full');
                    sidebar.classList.add('translate-x-0'); // Tailwind lg ya lo fuerza estático
                    overlay.classList.add('hidden');
                    if (menuBtn) menuBtn.setAttribute('aria-expanded', 'false');
                } else {
                    // Modo móvil: aseguramos que sidebar empieza oculto si no lo está
                    // pero si está abierto por redimension, lo dejamos como está; normalmente lo ocultamos por defecto.
                    // Sin embargo, para consistencia: si no tiene clase que lo oculte, se la ponemos (menos si está abierto manualmente)
                    if (!sidebar.classList.contains('translate-x-0') && !sidebar.classList.contains('sidebar-hidden')) {
                        // Caso inicial: lo ocultamos
                        sidebar.classList.add('sidebar-hidden');
                    }
                }
            });

            // Inicializar estado en móvil: sidebar oculto, overlay oculto.
            if (window.innerWidth < 1024) {
                sidebar.classList.add('sidebar-hidden');
                sidebar.classList.remove('translate-x-0');
                overlay.classList.add('hidden');
            } else {
                sidebar.classList.remove('sidebar-hidden', '-translate-x-full');
                overlay.classList.add('hidden');
            }
        })();
    </script>
</body>
</html>
@endsection