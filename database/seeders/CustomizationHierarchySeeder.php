<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customizations\Customization;
use App\Models\Products\Product;
use App\Models\Materials\Material;
use App\Models\Customizations\CustomizationHierarchy;
use Carbon\Carbon;

class CustomizationHierarchySeeder extends Seeder
{
    public function run(): void
    {
        $categories = Product::distinct()->pluck('category');
        $ores = Material::whereBetween('id', [1, 10])->get();

        //Tipos de Material
        foreach ($ores as $ore) {
            $customization = CustomizationHierarchy::create([
                'name' => $ore['name'],
                'description' => $ore['description'],
                'customization_id' => 1,
                'parent_id' => null,
                'additional_cost' => 0,
            ]);

            // Asocia las categorías a la personalización en la tabla intermedia
            foreach ($categories as $category) {
                $customization->categories()->create([
                    'category' => $category,
                ]);
            }
        }
        //Tipos de Material

        //Tipos de Gemstone
        $gemstones = Material::whereBetween('id', [11, 20])->get();
        foreach ($gemstones as $gemstone) {
            $customization = CustomizationHierarchy::create([
                'name' => $gemstone['name'],
                'description' => $gemstone['description'],
                'customization_id' => 2,
                'parent_id' => null,
                'additional_cost' => 0,
            ]);

            // Asocia las categorías a la personalización en la tabla intermedia
            foreach ($categories as $category) {
                $customization->categories()->create([
                    'category' => $category,
                ]);
            }
        }
        //Tipos de Gemstone
        
        // Tipos de cortes
        $cutTypes = [
            ['name' => 'Redondo', 'description' => 'Corte redondo para piedras preciosas'],
            ['name' => 'Ovalado', 'description' => 'Corte ovalado, elegante y clásico'],
            ['name' => 'Pera', 'description' => 'Corte en forma de pera, moderno y sofisticado'],
            ['name' => 'Marquesa', 'description' => 'Corte marquesa con un diseño estilizado'],
            ['name' => 'Corazón', 'description' => 'Corte en forma de corazón, ideal para joyería romántica']
        ];

        foreach ($cutTypes as $type) {
            $customization = CustomizationHierarchy::create([
                'name' => $type['name'],
                'description' => $type['description'],
                'customization_id' => 2,
                'parent_id' => null,
                'additional_cost' => 0,
            ]);

            // Asocia las categorías al tipo de corte
            foreach ($categories as $category) {
                $customization->categories()->firstOrCreate([
                    'customization_hierarchy_id' => $customization->id,
                    'category' => $category,
                ]);
            }
        }


        //Tipos de montura
        $mountTypes = [
            ['name' => 'Montura Solitario', 'description' => 'Montura de tipo Solitario'],
            ['name' => 'Montura Halo', 'description' => 'Montura de tipo Halo'],
            ['name' => 'Montura Pavé', 'description' => 'Montura de tipo Pavé'],
        ];
        $category = 'Anillos';

        foreach ($mountTypes as $mountType) {
            $customization = CustomizationHierarchy::create([
                'name' => $mountType['name'],
                'description' => $mountType['description'],
                'customization_id' => 6,
                'parent_id' => null,
                'additional_cost' => 0,
            ]);

            // Asocia la categoría a la montura
            $customization->categories()->firstOrCreate([
                'customization_hierarchy_id' => $customization->id,
                'category' => $category,
            ]);
        }
        //Tipos de montura

        //Tipos de estilos
        $prodStyles = [
            CustomizationHierarchy::create([
                'name' => 'Forma del Aro',
                'description' => 'Variaciones en la forma del aro, desde opciones clásicas hasta estilos contemporáneos, que permiten personalizar la apariencia y el estilo de la joya.',
                'customization_id' => 5,
                'parent_id' => null,
                'additional_cost' => 0,
            ]),

            CustomizationHierarchy::create([
                'name' => 'Tipo del brazalete',
                'description' => 'Diferentes tipos de brazaletes que se adaptan a diversas preferencias de estilo, desde diseños ajustables hasta modelos rígidos y con cierres únicos.',
                'customization_id' => 5,
                'parent_id' => null,
                'additional_cost' => 0,
            ])
        ];

        $aroStyles = [
            ['name' => 'Aros de círculo', 'description' => 'Aros de forma circular, clásicos y elegantes, ideales para cualquier ocasión.'],
            ['name' => 'Aros ovalados', 'description' => 'Aros con un diseño ovalado que aporta un toque sofisticado y moderno.'],
            ['name' => 'Aros en espiral', 'description' => 'Aros con un diseño en espiral que añade dinamismo y estilo único a cualquier look.'],
            ['name' => 'Aros geométricos', 'description' => 'Aros con formas geométricas, perfectos para quienes buscan un estilo contemporáneo y atrevido.'],
            ['name' => 'Aros colgantes', 'description' => 'Aros que cuelgan para un look elegante y llamativo, perfectos para eventos formales.'],
        ];
        $brazaleteStyles = [
            ['name' => 'Brazalete ajustable', 'description' => 'Brazalete diseñado para ajustarse a diferentes tamaños de muñeca, ofreciendo comodidad y versatilidad.'],
            ['name' => 'Brazalete rigido', 'description' => 'Brazalete sólido y rígido que aporta un estilo definido y sofisticado.'],
            ['name' => 'Brazalete con cierre', 'description' => 'Brazalete con un sistema de cierre seguro, ideal para llevar con confianza durante todo el día.'],
        ];

        foreach ($prodStyles as $prodStyle) {
            if ($prodStyle->name === 'Forma del Aro') {
                $styles = $aroStyles;
                $category = 'Aros';
            } elseif ($prodStyle->name === 'Tipo del brazalete') {
                $styles = $brazaleteStyles;
                $category = 'Brazalete';
            }

            foreach ($styles as $style) {
                $customization = CustomizationHierarchy::create([
                    'name' => $style['name'],
                    'description' => $style['description'],
                    'customization_id' => 5,
                    'parent_id' => $prodStyle->id,
                    'additional_cost' => 0,
                ]);
            
                // Asocia solo la categoría específica a la personalización en la tabla intermedia
                $customization->categories()->create([
                    'category' => $category,
                ]);
            }
        }
        //Tipos de estilos

        //Tipos de cierre
        $prodClosures = [CustomizationHierarchy::create([
            'name' => 'Tipo de cierre',
            'description' => 'Variedad de tipos de cierre diseñados para asegurar la joya con comodidad y firmeza, adaptándose a diferentes estilos y necesidades de uso.',
            'customization_id' => 8,
            'parent_id' => null,
            'additional_cost' => 0,
        ])];
        
        $aroClosureType =  [
            ['name' => 'Cierre de presión', 'description' => 'Cierre seguro que se sujeta al lóbulo de la oreja mediante presión, proporcionando comodidad y estabilidad.'],
            ['name' => 'Cierre de gancho', 'description' => 'Cierre sencillo que permite colocar y retirar los aros fácilmente, ideal para diseños colgantes.'],
            ['name' => 'Cierre de abrazadera', 'description' => 'Cierre con mecanismo de abrazadera que asegura el aro con firmeza, manteniéndolo en su lugar.'],
            ['name' => 'Cierre de rosca', 'description' => 'Cierre que se enrosca para una fijación extra segura, perfecto para aros que se usan durante largos periodos.'],
            ['name' => 'Cierre de mariposa', 'description' => 'Cierre clásico con forma de mariposa que ofrece un ajuste cómodo y seguro para aros pequeños y medianos.'],
        ];
        
        $brazaleteClosureType =  [
            ['name' => 'Cierre de mosquetón', 'description' => 'Cierre de gancho con resorte que se sujeta de manera segura y es fácil de usar, ideal para brazaletes.'],
            ['name' => 'Cierre ajustable', 'description' => 'Cierre que permite ajustar el tamaño del brazalete según la medida de la muñeca, brindando flexibilidad.'],
            ['name' => 'Cierre imantado', 'description' => 'Cierre magnético que facilita la colocación y retirada del brazalete, proporcionando un uso rápido y cómodo.'],
            ['name' => 'Cierre con broche', 'description' => 'Cierre de broche que ofrece un mecanismo sencillo y seguro, ideal para el uso diario.'],
            ['name' => 'Cierre de gancho', 'description' => 'Cierre en forma de gancho que asegura el brazalete de manera fácil y rápida.'],
        ];

        $collarClosureType =  [
            ['name' => 'Cierre de mosquetón', 'description' => 'Cierre de gancho con resorte que se sujeta de manera segura y es fácil de usar, ideal para brazaletes.'],
            ['name' => 'Cierre ajustable', 'description' => 'Cierre que permite ajustar el tamaño del brazalete según la medida de la muñeca, brindando flexibilidad.'],
            ['name' => 'Cierre imantado', 'description' => 'Cierre magnético que facilita la colocación y retirada del brazalete, proporcionando un uso rápido y cómodo.'],
            ['name' => 'Cierre con broche', 'description' => 'Cierre de broche que ofrece un mecanismo sencillo y seguro, ideal para el uso diario.'],
            ['name' => 'Cierre de gancho', 'description' => 'Cierre en forma de gancho que asegura el brazalete de manera fácil y rápida.'],
        ];
        
        foreach ($prodClosures as $prodClosure) {
            foreach ($aroClosureType as $closureType) {
                $customization = CustomizationHierarchy::create([
                    'name' => $closureType['name'],
                    'description' => $closureType['description'],
                    'customization_id' => 8,
                    'parent_id' => $prodClosure->id,
                    'additional_cost' => 0,
                ]);
        
                $customization->categories()->create([
                    'category' => 'Aros',
                ]);
            }
        }
        foreach ($prodClosures as $prodClosure) {
            foreach ($brazaleteClosureType as $closureType) {
                $customization = CustomizationHierarchy::create([
                    'name' => $closureType['name'],
                    'description' => $closureType['description'],
                    'customization_id' => 8,
                    'parent_id' => $prodClosure->id,
                    'additional_cost' => 0,
                ]);
        
                $customization->categories()->create([
                    'category' => 'Brazaletes',
                ]);
            }
        }
        foreach ($prodClosures as $prodClosure) {
            foreach ($collarClosureType as $closureType) {
                $customization = CustomizationHierarchy::create([
                    'name' => $closureType['name'],
                    'description' => $closureType['description'],
                    'customization_id' => 8,
                    'parent_id' => $prodClosure->id,
                    'additional_cost' => 0,
                ]);
        
                $customization->categories()->create([
                    'category' => 'Collares',
                ]);
            }
        }
        //Tipos de cierre

        //Tipo de Grabado
        $prodEngravings = [CustomizationHierarchy::create([
            'name' => 'Tipo de Grabado',
            'description' => 'Variedad de tipos de grabados.',
            'customization_id' => 3,
            'parent_id' => null,
            'additional_cost' => 0,
        ])];

        $engravingTypes = [
            ['name' => 'Iniciales', 'description' => 'Grabado de iniciales'],
            ['name' => 'Nombre o Palabra', 'description' => 'Grabado de nombre o palabra'],
            ['name' => 'Fecha conmemorativa', 'description' => 'Grabado de Fecha Conmemorativa'],
            ['name' => 'Símbolo de corazón', 'description' => 'Grabado de un símbolo de corazón'],
            ['name' => 'Símbolo infinito', 'description' => 'Grabado de un símbolo de infinito'],
            ['name' => 'Símbolo estrella', 'description' => 'Grabado de un símbolo de estrella'],
            ['name' => 'Mensaje corto', 'description' => 'Grabado de un mensaje corto']
        ];

        foreach ($prodEngravings as $prodEngraving) {
            foreach ($engravingTypes as $engravingType) {
                $customization = CustomizationHierarchy::create([
                    'name' => $engravingType['name'],
                    'description' => $engravingType['description'],
                    'customization_id' => 3,
                    'parent_id' => $prodEngraving->id,
                    'additional_cost' => 0,
                ]);
                
                // Asocia las categorías a la personalización en la tabla intermedia
                foreach ($categories as $category) {
                    $customization->categories()->create([
                        'category' => $category,
                    ]);
                }
            }
        }
        //Tipo de Grabado

        //Tipo de Acabado
        $prodFinishings = [CustomizationHierarchy::create([
            'name' => 'Tipo de Acabado',
            'description' => 'Variedad de tipos de acabados.',
            'customization_id' => 4,
            'parent_id' => null,
            'additional_cost' => 0,
        ])];

        $finishingTypes = [
            ['name' => 'Acabado Mate', 'description' => 'Acabado Mate'],
            ['name' => 'Acabado Pulido', 'description' => 'Acabado Pulido'],
            ['name' => 'Acabado Martillado', 'description' => 'Acabado Martillado'],
            ['name' => 'Acabado Satinado', 'description' => 'Acabado Satinado'],
            ['name' => 'Acabado Cepillado', 'description' => 'Acabado Cepillado'],
            ['name' => 'Bañado', 'description' => 'Acabado Bañado'],
        ];

        $subFinishingTypes = [
            ['name' => 'Bañado en oro', 'description' => 'Bañado en oro para un acabado lujoso'],
            ['name' => 'Bañado en plata', 'description' => 'Bañado en plata para un brillo clásico'],
        ];

        foreach ($prodFinishings as $prodFinishing) {
            foreach ($finishingTypes as $finishingType) {
                $customization = CustomizationHierarchy::create([
                    'name' => $finishingType['name'],
                    'description' => $finishingType['description'],
                    'customization_id' => 4,
                    'parent_id' => $prodFinishing->id,
                    'additional_cost' => 0,
                ]);
                if ($finishingType['name'] === 'Bañado' && $customization) {
                    foreach ($subFinishingTypes as $subFinishingType) {
                        CustomizationHierarchy::create([
                            'name' => $subFinishingType['name'],
                            'description' => $subFinishingType['description'],
                            'customization_id' => 4,
                            'parent_id' => $customization->id,
                            'additional_cost' => 0,
                        ]);
                    }
                }
                
                // Asocia las categorías a la personalización en la tabla intermedia
                foreach ($categories as $category) {
                    $customization->categories()->create([
                        'category' => $category,
                    ]);
                }
            }
        }
        //Tipo de Acabado

        //Tipo de Anchura
        $prodWidths = [CustomizationHierarchy::create([
            'name' => 'Ancho del Anillo',
            'description' => 'Variedad de Anchos del Anillo.',
            'customization_id' => 10,
            'parent_id' => null,
            'additional_cost' => 0,
        ])];

        $widthTypes = [
            ['name' => 'Ancho de 2 mm', 'description' => 'Anillo de Ancho de 2 mm'],
            ['name' => 'Ancho de 4 mm', 'description' => 'Anillo de Ancho de 4 mm'],
            ['name' => 'Ancho de 6 mm', 'description' => 'Anillo de Ancho de 6 mm'],
            ['name' => 'Ancho de 8 mm', 'description' => 'Anillo de Ancho de 8 mm'],
            ['name' => 'Ancho de 10 mm', 'description' => 'Anillo de Ancho de 10 mm'],
        ];
        $category = 'Anillos';
        foreach ($prodWidths as $prodWidth) {
            foreach ($widthTypes as $widthType) {
                $customization = CustomizationHierarchy::create([
                    'name' => $widthType['name'],
                    'description' => $widthType['description'],
                    'customization_id' => 10,
                    'parent_id' => $prodWidth->id,
                    'additional_cost' => 0,
                ]);
                
                $customization->categories()->create([
                    'category' => $category,
                ]);
            }
        }
        //Tipo de Anchura

        //Tipo de diseño
        $prodDesigns = [CustomizationHierarchy::create([
            'name' => 'Diseño de la cadena',
            'description' => 'Variedad de Diseños de cadena.',
            'customization_id' => 7,
            'parent_id' => null,
            'additional_cost' => 0,
        ])];
        $designTypes = [
            ['name' => 'Cadena simple', 'description' => 'Brazalete con cadena simple'],
            ['name' => 'Trenzado', 'description' => 'Brazalete con cadena trenzada'],
            ['name' => 'Eslabones grandes', 'description' => 'Brazalete con cadena de eslabones grandes'],
        ];
        $category = 'Brazaletes';
        foreach ($prodDesigns as $prodDesign) {
            foreach ($designTypes as $designType) {
                $customization = CustomizationHierarchy::create([
                    'name' => $designType['name'],
                    'description' => $designType['description'],
                    'customization_id' => 7,
                    'parent_id' => $prodDesign->id,
                    'additional_cost' => 0,
                ]);
                
                $customization->categories()->create([
                    'category' => $category,
                ]);
            }
        }
        //Tipo de diseño

        //Tipo de Longitud
        $prodLengths = [CustomizationHierarchy::create([
            'name' => 'Longitud de ',
            'description' => 'Variedad de Diseños de cadena.',
            'customization_id' => 9,
            'parent_id' => null,
            'additional_cost' => 0,
        ])];

        $lengthTypes = [
            ['name' => 'Cadena corta', 'description' => 'Cadena corta de 40cm'],
            ['name' => 'Cadena mediana', 'description' => 'Cadena mediana de 50 cm'],
            ['name' => 'Cadena larga', 'description' => 'Cadena larga de 60 cm'],
            ['name' => 'Cadena ajustable', 'description' => 'Cadena ajustable de 45 cm a 55 cm'],
            ['name' => 'Cadena gargantilla', 'description' => 'Cadena tipo gargantilla de 30 cm'],
        ];
        $category = 'Collares';
        foreach ($prodLengths as $prodLength) {
            foreach ($lengthTypes as $lengthType) {
                $customization = CustomizationHierarchy::create([
                    'name' => $lengthType['name'],
                    'description' => $lengthType['description'],
                    'customization_id' => 7,
                    'parent_id' => $prodLength->id,
                    'additional_cost' => 0,
                ]);
                
                $customization->categories()->create([
                    'category' => $category,
                ]);
            }
        }
        //Tipo de Longitud
    }
}
