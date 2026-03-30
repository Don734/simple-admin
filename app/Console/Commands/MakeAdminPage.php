<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeAdminPage extends Command
{
    protected $signature = 'make:admin-page {name : Component name, e.g. Dashboard/Index or Users/Index}';

    protected $description = 'Create a Livewire component with its view in resources/views/admin/pages';

    public function handle(): int
    {
        $name = str_replace('\\', '/', trim($this->argument('name'), '/\\'));

        $parts      = explode('/', $name);
        $className  = array_pop($parts);
        $subNs      = implode('\\', $parts);
        $subPath    = implode('/', $parts);

        $classNamespace = 'App\\Livewire\\Admin' . ($subNs ? '\\' . $subNs : '');
        $classDir       = app_path('Livewire/Admin' . ($subPath ? '/' . $subPath : ''));
        $classFile      = $classDir . '/' . $className . '.php';

        $viewSubPath    = ($subPath ? Str::lower($subPath) . '/' : '') . Str::kebab($className);
        $viewDir        = resource_path('views/admin/pages' . ($subPath ? '/' . Str::lower($subPath) : ''));
        $viewFile       = resource_path('views/admin/pages/' . $viewSubPath . '.blade.php');
        $viewName       = 'admin.pages.' . str_replace('/', '.', $viewSubPath);

        if (file_exists($classFile)) {
            $this->components->error("Class already exists: {$classFile}");
            return self::FAILURE;
        }

        if (file_exists($viewFile)) {
            $this->components->error("View already exists: {$viewFile}");
            return self::FAILURE;
        }

        // Create directories
        if (! is_dir($classDir)) {
            mkdir($classDir, 0755, true);
        }

        if (! is_dir($viewDir)) {
            mkdir($viewDir, 0755, true);
        }

        // Write class
        $pageTitle = Str::headline(Str::kebab($className));

        file_put_contents($classFile, $this->classStub($classNamespace, $className, $viewName, $pageTitle));

        // Write blade view
        file_put_contents($viewFile, $this->viewStub());

        $this->components->info("Livewire component created: <fg=cyan>app/Livewire/Admin/{$name}.php</>");
        $this->components->info("Blade view created:          <fg=cyan>resources/views/admin/pages/{$viewSubPath}.blade.php</>");

        return self::SUCCESS;
    }

    private function classStub(string $namespace, string $className, string $viewName, string $pageTitle): string
    {
        return <<<PHP
        <?php

        namespace {$namespace};

        use Livewire\Attributes\Layout;
        use Livewire\Attributes\Title;
        use Livewire\Component;

        #[Layout('layouts.admin')]
        #[Title('{$pageTitle}')]
        class {$className} extends Component
        {
            public function render()
            {
                return view('{$viewName}');
            }
        }
        PHP;
    }

    private function viewStub(): string
    {
        return <<<BLADE
        <div>
            @push('breadcrumb')
                @include('admin.partials.breadcrumb', [
                    'title' => 'Page Title',
                    'list' => [
                        ['name' => 'Page Title', 'current' => true],
                    ],
                ])
            @endpush

            {{-- Content --}}
        </div>
        BLADE;
    }
}
