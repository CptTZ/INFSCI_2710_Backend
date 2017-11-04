Pitt INFSCI 2710 Project Backend
===

PittMoments!

## Basic intro

Django based backend API!

## Prepare Environment

Assuming you have **python3** and **pip** installed, and **Python3** has been set to default python environment.

1. Install dependencies

```python -m pip install -r requirements.txt```

2. Migration database (Tmp solution)

```python manage.py migrate```

3. Create the first superuser

Input whatever you like, leave blank for email, just have to remember that...

```python manage.py createsuperuser```

4. Ready to GO!

```python manage.py runserver```
