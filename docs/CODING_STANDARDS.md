# Informe Técnico: Estándares de Codificación

- [cite_start]**Nombre del programa Formativo:** Tecnólogo en Análisis y Desarrollo de Software [cite: 444]
- [cite_start]**Nombre del aprendiz:** Eder Aleison Galeano Quintero [cite: 445]
- [cite_start]**Nombre del instructor:** Hernán Felipe Calderón García [cite: 446]
- [cite_start]**Fecha:** 03/09/25 [cite: 447]

---

## Introducción

[cite_start]El presente documento establece el conjunto de estándares y buenas prácticas de codificación que serán adoptados para el desarrollo del proyecto 'Timely', un sistema de gestión de horarios para instituciones educativas. [cite: 450] [cite_start]El objetivo principal de estos estándares es garantizar la calidad, legibilidad, consistencia y mantenibilidad del código fuente a lo largo de todo el ciclo de vida del software, facilitando así el trabajo colaborativo y la futura escalabilidad del proyecto. [cite: 451]

---

## 1. Selección de Herramientas y Flujo de Trabajo

### 1.1. Control de Versiones Local
- [cite_start]**Git** será la herramienta principal para el control de versiones en el entorno local. [cite: 453]
- [cite_start]Se usarán commits atómicos y descriptivos siguiendo la convención **Conventional Commits**. [cite: 454]
  - [cite_start]`feat: agregar modelo Schedule` [cite: 456]
  - [cite_start]`fix: corregir validación de disponibilidad docente` [cite: 458]

### 1.2. Repositorio Remoto
- [cite_start]**GitHub** se utilizará como repositorio remoto. [cite: 460]
- [cite_start]Se habilitarán `branch protections` para la rama principal (`main`). [cite: 462]

### 1.3. Integración Continua
- Se implementará **GitHub Actions** para ejecutar:
  - [cite_start]Pruebas automáticas con **PHPUnit**. [cite: 465]
  - [cite_start]Análisis estático de código (**PHPStan / Larastan**). [cite: 466]
  - [cite_start]Revisión de estilo con **PHP CS Fixer**. [cite: 467]

### 1.4. Flujo de Ramas
- [cite_start]Se seguirá el flujo **GitFlow simplificado**: [cite: 469]
  - [cite_start]`main`: rama estable y de producción. [cite: 470]
  - [cite_start]`develop`: rama de integración donde se unen nuevas funcionalidades. [cite: 471]
  - [cite_start]`feature/nombre-funcionalidad`: ramas de desarrollo para nuevas características. [cite: 472]
  - `hotfix/nombre-arreglo`: ramas de correcciones urgentes.

---

## 2. Estándares de Codificación

### 2.1. PHP / Laravel
- **Variables:** Uso de `camelCase`. [cite_start]Ejemplo: `$horarioDisponible = true;` [cite: 474, 476]
- **Constantes:** Uso de `MAYÚSCULAS_CON_GUIONES_BAJOS`. [cite_start]Ejemplo: `const MAX_HORAS_DIA = 8;` [cite: 478, 480]
- **Clases:** Nombre en `PascalCase` y singular. [cite_start]Ejemplo: `class ScheduleGenerator {}` [cite: 482, 484]
- **Métodos:** Uso de `camelCase`, con verbos descriptivos. [cite_start]Ejemplo: `public function generateAutomaticSchedule() {}` [cite: 486, 488]
- [cite_start]**Carpetas:** Seguir la estructura estándar de Laravel: [cite: 490]
  - [cite_start]`/app/Models` → modelos [cite: 491]
  - [cite_start]`/app/Http/Controllers` → controladores [cite: 492]
  - [cite_start]`/database/migrations` → migraciones [cite: 494]
  - [cite_start]`/tests` → pruebas automatizadas [cite: 496]
- [cite_start]**Documentación:** Se usará `PHPDoc` en clases y métodos. [cite: 498]
- [cite_start]**Buenas Prácticas:** Seguir el estándar **PSR-12**, usar inyección de dependencias y aplicar principios **SOLID**. [cite: 505]

### 2.2. HTML y CSS
- [cite_start]**Indentación:** Se utilizará una indentación de 4 espacios. [cite: 508]
- [cite_start]**Nomenclatura de clases CSS:** Se empleará la metodología BEM (Bloque, Elemento, Modificador). [cite: 509]
- [cite_start]**Comentarios:** Se comentarán las secciones complejas o importantes del código. [cite: 511]

### 2.3. Base de Datos
[cite_start]Para relaciones de "muchos a muchos" (ej. un profesor imparte muchas asignaturas y una asignatura es impartida por muchos profesores), se debe crear una tabla pivote o "puente" para conectar ambas entidades. [cite: 513]

---

## 3. Ejemplos Prácticos (Correcto vs. Incorrecto)

### 3.1. Nomenclatura de Controladores
- [cite_start]❌ **Incorrecto:** `space_controller.php` [cite: 516]
- [cite_start]✅ **Correcto:** `SpaceController.php` [cite: 517]

### 3.2. Definición de Rutas
- ✅ **Correcto (Usando `Route::resource`):**
  ![Ruta correcta en web.php](/docs/images/web.png)
- ❌ **Incorrecto (Definiendo rutas manualmente):**
  ![Rutas incorrectas en web.php](/docs/images/webeerror.png)

### 3.3. Mensajes de Commit en Git
- ✅ **Correcto (Descriptivo):**
feat: agregar paginación a la lista de espacios

Se implementa la paginación en la vista principal de espacios para mejorar el rendimiento cuando hay muchos registros.

- ❌ **Incorrecto (Vago):**
git commit -m "cambios"
git commit -m "arreglado"


---

## 4. Validación Práctica

[cite_start]Para la validación práctica de estos estándares, se desarrolló el módulo inicial de **'Gestión de Espacios'** del proyecto Timely. [cite: 532] [cite_start]Dicho módulo incluye su modelo, migración, controlador con métodos CRUD y vistas, y fue codificado aplicando rigurosamente las reglas definidas en este documento. [cite: 533]

### 4.1. Migración
![Código de la migración de Espacios](/docs/images/migracion.png)

### 4.2. Modelo
![Código del modelo Space](/docs/images/modelo.png)

### 4.3. Controlador
![Código del SpaceController (parte 1)](/docs/images/controlador.png)
![Código del SpaceController (parte 2)](/docs/images/controlador1.png)

### 4.4. Vistas (Blade)
- **Formulario de Creación:**
![Vista para crear un nuevo espacio](/docs/images/crears.png)
- **Listado de Espacios:**
![Vista que muestra los espacios registrados](/docs/images/vista.png)

### 4.5. Visualización Final
- **Listado:**
![Resultado final del listado de espacios](/docs/images/visualizacion.png)
![Resultado final del listado de espacios (alternativo)](/docs/images/visualizacion1.png)
