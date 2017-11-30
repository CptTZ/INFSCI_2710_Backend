from django.db import models

def user_directory_path(instance, filename):
    # file will be uploaded to MEDIA_ROOT/user_<id>/<filename>
    return 'user_{0}/{1}'.format(instance.username, filename)

class User(models.Model):
    genders = (('M','MALE'),('F','FEMALE'),('N','NOT_SPECIFIED'))

    username = models.CharField(primary_key=True, max_length=20)
    password = models.CharField(max_length=15)
    nickname = models.CharField(max_length=20, null=True)
    firstname = models.CharField(max_length=20, null=True)
    lastname = models.CharField(max_length=20, null=True)
    gender = models.CharField(max_length=1,choices=genders, default='N')
    DOB = models.DateField(null=True)
    region = models.CharField(max_length=20, null=True)
    whatsup = models.CharField(max_length=50, null=True)
    avatar = models.FileField(upload_to=user_directory_path, null=True)
    email = models.EmailField(null=True)
    mobile = models.IntegerField(null=True)
    website = models.CharField(max_length=50, null=True)
    bio = models.TextField(blank=True, null=True)
    last_login = models.DateTimeField(auto_now=True)
    date_joined = models.DateTimeField(auto_now_add=True)
    posts_num = models.IntegerField(default=0)
    follower_num = models.IntegerField(default=0)
    following_num = models.IntegerField(default=0)
    is_active = models.BooleanField(default=True) #auto not null
    is_superuser = models.BooleanField(default=False)

class Post(models.Model):
    username = models.ForeignKey(User, on_delete=models.CASCADE, blank=False, null=False)
    contents = models.TextField(max_length=300, blank=False, null=False)
    timestamp = models.DateTimeField(auto_now_add=True, null=False)
    share_to = models.TextField(blank=True, null=True)
    at_list = models.TextField(blank=True, null=True)
    picNum = models.IntegerField(default=0, null=True)
    pic_ids = models.FileField(blank=True, null=True, upload_to=user_directory_path)

class Comments(models.Model):
    pid = models.ForeignKey(Post, on_delete=models.CASCADE, blank=False, null=False)
    username = models.ForeignKey(User, on_delete=models.CASCADE, blank=False, null=False)
    contents = models.CharField(max_length=200, blank=False, null=False)
    timestamp = models.DateTimeField(auto_now_add=True, null=False)
    at_list = models.TextField(blank=True, null=True)

class Likes(models.Model):
    pid = models.ForeignKey(Post, on_delete=models.CASCADE, blank=False, null=False)
    username = models.ForeignKey(User, on_delete=models.CASCADE, blank=False, null=False)
    timestamp = models.DateTimeField(auto_now_add=True, null=False)
    unique_together = (pid, username)

class Relations(models.Model):
    follower_username = models.ForeignKey(User, on_delete=models.CASCADE, blank=False, null=False)
    followed_username = models.ForeignKey(User, on_delete=models.CASCADE, blank=False, null=False)
    if_notify = models.BooleanField(default=True) #auto not null
    timestamp = models.DateTimeField(auto_now_add=True, null=False)
    unique_together = (follower_username, followed_username)

class Block(models.Model):
    username = models.ForeignKey(User, on_delete=models.CASCADE, blank=False, null=False)
    pid = models.ForeignKey(Post, on_delete=models.CASCADE, blank=False, null=False)
    timestamp = models.DateTimeField(auto_now_add=True, null=False)
    unique_together = (username, pid)

class Collections(models.Model):
    username = models.ForeignKey(User, on_delete=models.CASCADE, blank=False, null=False)
    contents = models.ForeignKey(Post, on_delete=models.CASCADE, blank=False, null=False)
    timestamp = models.DateTimeField(auto_now_add=True, null=False)
    unique_together = (username, contents)

class Report(models.Model):
    er_username = models.ForeignKey(User, on_delete=models.CASCADE, blank=False, null=False)
    ee_username = models.ForeignKey(User, on_delete=models.CASCADE, blank=False, null=False)
    pid = models.ForeignKey(Post, on_delete=models.CASCADE, blank=True, null=True)
    reasons = models.TextField(blank=True, null=True)
    timestamp = models.DateTimeField(auto_now_add=True, null=False)

class Chat(models.Model):
    type = (('T','TEXT'),('P','PICTURE'))

    username1 = models.ForeignKey(User, on_delete=models.CASCADE, blank=False, null=False)
    username2 = models.ForeignKey(User, on_delete=models.CASCADE, blank=False, null=False)
    contents = models.TextField(max_length=300, blank=False, null=False)
    msg_type = models.CharField(max_length=1,choices=type, default='T')
    timestamp = models.DateTimeField(auto_now_add=True, null=False)
    unique_together = (username1, username2)