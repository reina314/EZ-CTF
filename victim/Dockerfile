FROM ubuntu:latest

# Prevents tzdata from prompting
ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y --no-install-recommends \
    openssh-server  \
    sudo            \
    vim             \
    less            \
    file            \
    lsof            \
    coreutils       \
    tree            \
    net-tools       \
    build-essential \
    && rm -rf /var/lib/apt/lists/*

# Create a user for initial access
RUN useradd -m -s /bin/bash ctfplayer && echo "ctfplayer:ctf1234" | chpasswd
# Create another user
RUN useradd -m -s /bin/bash john && echo "john:Im1337H4ck3r" | chpasswd
# Create yet another user
RUN useradd -m -s /bin/bash michael && echo "michael:Deducted" | chpasswd
# Create admin user for privilege escalation
RUN useradd -m -s /bin/bash reina && echo "reina:copycat" | chpasswd

# Grant sudo access using a custom rule
RUN echo "michael ALL=(reina) NOPASSWD: /usr/bin/vim" > /etc/sudoers.d/michael && \
    chmod 0440 /etc/sudoers.d/michael

# Setup SSH
RUN mkdir /var/run/sshd
# Allow password login
RUN sed -i 's/#PasswordAuthentication yes/PasswordAuthentication yes/' /etc/ssh/sshd_config
# Expose the SSH port
EXPOSE 22

# Add 1st flag
RUN echo 'FLAG{this_is_the_first_one!}' > /home/ctfplayer/flag0.txt && \
    chown ctfplayer:ctfplayer /home/ctfplayer/flag0.txt
# Add 2nd flag
RUN echo 'FLAG{how_did_you_find_me!?}' > /home/ctfplayer/.flag1.txt && \
    chown ctfplayer:ctfplayer /home/ctfplayer/.flag1.txt
# Add 3rd flag
RUN echo 'FLAG{im_at_home}' > /home/flag2.txt && \
    chown ctfplayer:ctfplayer /home/flag2.txt
# Add 4th flag ( FLAG{you_read_this_right} )
RUN echo 'RkxBR3t5b3VfcmVhZF90aGlzX3JpZ2h0fQ==' > /flag3.txt && \
    chmod 744 /flag3.txt
# Add 5th flag
RUN mkdir -p /tmp/i/came/too/deep && echo 'FLAG{wow_im_back_alive!}' > /tmp/i/came/too/deep/flag4.txt && \
    chmod 744 /tmp/i/came/too/deep/flag4.txt
# Add 6th flag && hint
RUN echo 'mysql -u john -pIm1337H4ck3r' >> /home/ctfplayer/.bash_history && \
    echo 'ls -al' >> /home/ctfplayer/.bash_history && \
    echo 'FLAG{always_keep_it_safe}' >> /home/ctfplayer/.bash_history && \
    chown ctfplayer:ctfplayer /home/ctfplayer/.bash_history
# Add 7th flag
RUN echo 'export SECRET=FLAG{convenient_but_dangerous_to_store_creds}' >> /home/john/.bashrc
# Add 8th flag
RUN chmod 755 /home/michael && \
    mkdir -p /home/michael/.ssh && \
    ssh-keygen -t rsa -b 2048 -f /home/michael/.ssh/id_rsa -q -N "" && \
    cp /home/michael/.ssh/id_rsa.pub /home/michael/.ssh/authorized_keys && \
    chown -R michael:michael /home/michael/.ssh && \
    chmod 755 /home/michael/.ssh && \
    chmod 644 /home/michael/.ssh/id_rsa && \
    chmod 600 /home/michael/.ssh/authorized_keys && \
    echo 'FLAG{keep_your_private_key_secure}' > /home/michael/flag7.txt && \
    chown michael:michael /home/michael/flag7.txt && \
    chmod 600 /home/michael/flag7.txt
# Add 9th flag & hint
RUN echo '2d61bfbcb50d147b98b46529894646f2' > /home/reina/md5_hashed_passwd.txt && \
    echo 'FLAG{be_careful_even_if_seemingly_safe}' > /home/reina/flag8.txt && \
    chown reina:reina /home/reina/flag8.txt
# Add 10th flag
RUN echo '#include <stdlib.h>' >> /home/reina/backup.c && \
    echo '#include <unistd.h>' >> /home/reina/backup.c && \
    echo 'int main() { setuid(0); setgid(0); system("cp -r /home/reina /tmp/backup"); return 0; }' >> /home/reina/backup.c && \
    gcc /home/reina/backup.c -o /home/reina/backup && \
    rm /home/reina/backup.c && \
    chown root:root /home/reina/backup && \
    chmod 4755 /home/reina/backup && \
    echo 'FLAG{you_are_skilled_enough!}' > /root/flag9.txt && \
    chown root:root /root/flag9.txt

# Start SSH on container boot
CMD ["/usr/sbin/sshd", "-D"]
