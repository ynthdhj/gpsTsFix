ȫ�Զ��޸�EVT��GPSʱ�������


��װ������ɺ�ȫ�Զ����У���Ҳ����Ҫ�˹�������

��LINUX�����У���Ҫ��װ j2sdk ��PHP
---------------------------------------

�յ���EVT�ļ����ڼ�С��1024�����ڣ�ʱ�䲻�䡣

���� EvtTsFix.jar �����޸ģ������θģ����ڲ����ۼӣ���Ȼ��ȷ����ȷ��EVT�޸ĺ���Ȼ��ȷ��



�������ܣ����� EvtTsFix.jar �����޸� EVT�ļ����޸�EVT�ļ������޸ı���EVT��Ŀ¼��



---------



�� config.php ���޸�EVT�ļ������Ŀ¼��

ʹ�ö�ʱִ�� ÿ����ִ��һ�Ρ�




--- ��һ��û��ִ����ɣ����ļ���������һ�β�����

ʹ��linux flock �ļ���ʵ�����������������ͻ

��ʽ��


flock [-sxon][-w #] file [-c] command

ѡ��

-s, --shared:    ���һ��������
-x, --exclusive: ���һ����ռ��
-u, --unlock:    �Ƴ�һ������ͨ���ǲ���Ҫ�ģ��ű�ִ������Զ�������
-n, --nonblock:  ���û�������������ֱ��ʧ�ܶ����ǵȴ�
-w, --timeout:   ���û��������������ȴ�ָ��ʱ��
-o, --close:     ����������ǰ�ر��ļ����������š����������������ӽ���ʱ�᲻�����Ĺܿ�
-c, --command:   ��shell������һ������������
-h, --help       ��ʾ����
-V, --version:   ��ʾ�汾

�ļ���ʹ�ö�ռ�������������ʧ�ܲ��ȴ�������Ϊ-xn

crontab -e : �޸� crontab �ļ�. ����ļ������ڻ��Զ������� 
crontab -l : ��ʾ crontab �ļ��� 
crontab -r : ɾ�� crontab �ļ���




crontab -e

* * * * * flock -xn /tmp/gpsTsFix.lock -c 'php /home/webapps/gpsTsFix/main.php > /dev/null'