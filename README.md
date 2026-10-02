# crm-clase-2


INFORME TÉCNICO — TALLER SEMANA 9
CRM "Gestión Integral de Negocios" — ALP-365
Docente: Ing. José Daniel Cadenas L. Fecha: _30__/09/2026
👤 Datos del estudiante
Nombre y apellido: luben perez
Cédula: V-28653652 (IMPORTANTE: con esta cédula se asignan las preguntas de la defensa)
Sección: b (A / B)
Grupo N°: 
Correo institucional: lubenrpg@gmail.com
Repositorio GitHub: https://github.com/_______________



🎯 Asignación de preguntas de defensa


Los 3 últimos dígitos de mi cédula son: 652 La suma de estos dígitos es: ___13___ El resultado de
(suma % 10) es: __3____ Mi SET de preguntas asignado es: SET _D___ (letra A–J)



✅ EVIDENCIA 1 — Capturas de los 2 reportes (2%)
Reporte 1 — Clientes por Zona: [INSERTAR CAPTURA]

en el pdf   



Reporte 2 — Interacciones por Asesor: [INSERTAR CAPTURA]


en el pdf




✅ EVIDENCIA 2 — Respuestas a las 6 preguntas de comprensión (3%)

P1. 

Si cambio WHERE zona_geografica = 'Oeste' por WHERE zona_geografica LIKE '%Este%', ¿qué clientes
aparecerán?
R: Van a salir todos los clientes que tengan la palabra 'Este' en su zona, sin importar si hay letras antes o
después. O sea, saldrían los del 'Este', pero también si existiera algo como 'Noreste' o 'Sureste', porque el
El símbolo % funciona como un comodín.


P2. 

¿Qué pasaría si quito el GROUP BY y dejo solo SELECT zona_geografica, COUNT(*)? ¿Funcionaría? ¿Por qué?
qué?

R: No va a funcionar. Nos va a tirar un error de sintaxis en SQL. Esto pasa porque estamos mezclando una
columna normal (zona_geografica) con una función para contar (COUNT), y la base de datos no sabe cómo
agrupar esos datos si no usamos explícitamente el GROUP BY.


P3. 

Tenemos 3 asesores. Ana tiene 5 clientes. Carlos tiene 0 clientes. María tiene 3 clientes. ¿Qué mostrará un INNER
¿Un JOIN para Carlos? ¿Y un LEFT JOIN?

R: Si le metemos un INNER JOIN, Carlos ni siquiera sale en la lista porque no tiene clientes relacionados en la
otra tabla. Pero si usamos un LEFT JOIN, Carlos sí aparece con 0 clientes, porque el LEFT nos obliga
a traer a todos los asesores, no importa si tienen clientes o no.

P4.

 En el reporte de interacciones por asesor, ¿por qué usamos LEFT JOIN y no INNER JOIN?
R: Porque necesitamos ver a todos los asesores en el reporte, incluso a los que no han hecho ni una sola
llamada o visita. Si usamos INNER JOIN, los asesores que están en cero simplemente se eliminan del reporte, y la
La idea es ver exactamente quiénes no están trabajando.


P5.

 ¿Qué hace DB::raw() y por qué debemos usarlo con cuidado?

DB::raw() permite ejecutar expresiones SQL sin procesarlas ni protegerlas de forma automática. Esto da más control sobre las consultas, pero también aumenta el riesgo de inyecciones SQL si no se usa correctamente. Por eso, hay que tener cuidado y evitar pasar datos sin validar o sin limpiar.
R: Básicamente sirve para meter código SQL puro directo en Laravel. Hay que tenerle mucho cuidado porque permite ejecutar consultas sin filtros de seguridad, lo que puede abrir la puerta a inyecciones SQL si no se maneja bien. Se recomienda usarlo solo cuando no hay otra opción y siempre validando los datos antes de enviarlos a la consulta.
desactiva las protecciones que trae Laravel por defecto contra inyecciones SQL, así que si le pasamos datos
Si un usuario mete datos directamente ahí, puede poner en riesgo la base de datos.

P6. 

¿Qué diferencia hay entre ->get() y ->first()?

R: Con ->get() ejecutamos la consulta y nos traemos todos los resultados metidos dentro de una Colección de
Laravel. En cambio, ->first() solo te trae el primer registro que encuentre. Si no hay ninguno, te devuelve null.
consigue nada.




✅ EVIDENCIA 3 — Código comentado de UN método (2%)
Copie el método de UNO de los reportes y coméntelo línea por línea:


public function clientesPorZona()
{
        // Hacemos la consulta a la tabla clients
        $zonas = DB::table('clients')

        // Seleccionamos la zona geográfica y contamos cuántos clientes hay en cada una
        ->select('zona_geografica', DB::raw('COUNT(*) as total'))

        // Agrupa los registros por zona geográfica
        ->groupBy('zona_geografica')

        // Ordena de mayor a menor según el total
        ->orderByDesc('total')

        // Ejecuta la consulta
        ->get();

    // 2. Calcula el total general de clientes
    $totalGeneral = $zonas->sum('total');

    // 3. Agrega el porcentaje a cada zona
    $zonasConPorcentaje = $zonas->map(function ($zona) use ($totalGeneral) {
        // Evita la división por cero
        $zona->porcentaje = $totalGeneral > 0
            ? round(($zona->total / $totalGeneral) * 100, 2)
            : 0;

        return $zona;
    });

    // 4. Extrae las etiquetas y los datos para la vista
    $labels = $zonasConPorcentaje->pluck('zona_geografica')->toArray();
    $data = $zonasConPorcentaje->pluck('total')->toArray();

    // 5. Retorna la vista con los datos necesarios
    return view('reports.zonas', compact(
        'zonasConPorcentaje',
        'totalGeneral',
        'labels',
        'data'
    ));
}



✅ EVIDENCIA 4 — Retos de modificación resueltos (2%)
Reto 1 (filtro > 15%):

    $zonasConPorcentaje = $zonasConPorcentaje-&gt;filter(function ($zona) {
    return $zona-&gt;porcentaje &gt; 15;
});

Reto 2 (desglose por día):

DB::raw(&quot;COUNT(CASE WHEN DAYNAME(interactions.fecha_seguimiento) = &#39;Monday&#39; THEN 1 END) AS lunes&quot;),
DB::raw(&quot;COUNT(CASE WHEN DAYNAME(interactions.fecha_seguimiento) = &#39;Tuesday&#39; THEN 1 END) AS
martes&quot;),
DB::raw(&quot;COUNT(CASE WHEN DAYNAME(interactions.fecha_seguimiento) = &#39;Wednesday&#39; THEN 1 END) AS
miercoles&quot;),
DB::raw(&quot;COUNT(CASE WHEN DAYNAME(interactions.fecha_seguimiento) = &#39;Thursday&#39; THEN 1 END) AS
jueves&quot;),
DB::raw(&quot;COUNT(CASE WHEN DAYNAME(interactions.fecha_seguimiento) = &#39;Friday&#39; THEN 1 END) AS
viernes&quot;),



✅ EVIDENCIA 5 — Reflexión breve (100 palabras)

Durante este taller, el concepto que me resultó más complejo de dominar fue la
implementación de los LEFT JOIN junto con las funciones condicionales como COUNT(CASE
WHEN...) dentro de DB::raw(). Entender cómo combinar correctamente estas cláusulas en el
Query Builder de Laravel sin romper la sintaxis ni comprometer la seguridad requirió
bastante análisis. Sin embargo, este conocimiento es vital. Aplicaré estas técnicas
directamente en el módulo de reportes del CRM &quot;Gestión Integral de Negocios&quot; para generar
estadísticas precisas sobre el rendimiento de los asesores y el seguimiento de los clientes.
Esto permitirá tomar decisiones informadas, visualizando gráficamente el impacto de las
interacciones y la distribución de la clientela.








1. ¿Qué hace COUNT(*)? ¿Cuándo lo usarías en el CRM?


R: COUNT(*) es una función de agregación en SQL que contabiliza la cantidad total de filas o registros devueltos por
una consulta, incluyendo filas con valores nulos o duplicados. En el CRM, lo usamos principalmente para obtener
métricas cuantitativas clave, como el total de clientes registrados en el sistema, la cantidad de clientes por zona
geográfica o el volumen histórico de interacciones generadas.


2. ¿Qué pasaría si usamos INNER JOIN en lugar de LEFT JOIN en el reporte 2?

Si usamos INNER JOIN, la consulta únicamente devolverá aquellos asesores que tengan
clientes asignados y que dichos clientes posean al menos una interacción registrada en la
tabla (‘interactions’). Los asesores que aún no hayan gestionado ninguna llamada, visita o
mensaje de WhatsApp serían automáticamente excluidos del reporte, distorsionando el
análisis del equipo comercial y mostrando una lista incompleta.



3. ¿Qué es una Collection de Laravel? Menciona 2 métodos que usaste.

 
R: Una Collection en Laravel es un envoltorio fluido y orientado a objetos (clase
Illuminate\Support\Collection) diseñado para manipular conjuntos de datos y matrices de
manera expresiva y eficiente sin tener que escribir bucles foreach manuales. Dos métodos
utilizados en el taller fueron: 1) ->sum(’total’) para acumular la sumatoria numérica del
total de clientes; y 2) -> punk(‘columna’) para extraer una columna específica en un arreglo
plano (como los nombres para las etiquetas de Chart.js). Adicionalmente usamos -> map() y
-> filter().




[CAPTURA DEL COMMIT]
en el pdf


📄 FIN DE LA PLANTILLA